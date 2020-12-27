<?php

namespace common\models;

use Imagine\Image\Box;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\FileHelper;
use yii\imagine\Image;

/**
 * This is the model class for table "{{%video}}".
 *
 * @property string $video_id
 * @property string $title
 * @property string|null $description
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $tags
 * @property int|null $status
 * @property int|null $has_thumbnail
 * @property string|null $video_name
 *
 * @property User $createdBy
 */
class Video extends \yii\db\ActiveRecord
{
    public const STATUS_UNLISTED = 0;
    public const STATUS_PUBLISHED = 1;

    /** @var \yii\web\UploadedFile */
    public $video;

    /** @var \yii\web\UploadedFile */
    public $thumbnail;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video}}';
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['video_id', 'title'], 'required'],
            [['description'], 'string'],
            [['created_by', 'created_at', 'updated_at', 'status', 'has_thumbnail'], 'integer'],
            [['video_id'], 'string', 'max' => 12],
            [['title', 'tags', 'video_name'], 'string', 'max' => 512],
            [['video_id'], 'unique'],
            [['has_thumbnail'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => self::STATUS_UNLISTED],
            [['video'], 'file', 'extensions' => 'mp4'],
            [['thumbnail'], 'image', 'minWidth' => 1280],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'video_id' => 'Video ID',
            'title' => 'Title',
            'description' => 'Description',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'tags' => 'Tags',
            'status' => 'Status',
            'has_thumbnail' => 'Has Thumbnail',
            'thumbnail' => 'Thumbnail',
            'video_name' => 'Video Name',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\VideoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\VideoQuery(get_called_class());
    }

    public function save($runValidation = true, $attributeNames = null)
    {

        $isCreate = $this->isNewRecord;

        if ($isCreate) {
            $this->video_id = Yii::$app->security->generateRandomString(8);
            $this->video_name = $this->video->name;
            $this->title = $this->video->name;
        }

        if ($this->thumbnail) {
            $this->has_thumbnail = 1;
        }
        $saved = parent::save($runValidation, $attributeNames);

        if (!$saved) {
            return false;
        }

        if ($isCreate) {
            $videoPath = Yii::getAlias('@frontend/web/storage/videos/' . $this->video_id . '.mp4');

            if (!is_dir(dirname($videoPath))) {
                FileHelper::createDirectory(dirname($videoPath));
            }
            $this->video->saveAs($videoPath);
        }

        if ($this->thumbnail) {
            $thumbPath = Yii::getAlias('@frontend/web/storage/thumbs/' . $this->video_id . '.jpg');

            if (!is_dir(dirname($thumbPath))) {
                FileHelper::createDirectory(dirname($thumbPath));
            }
            $this->thumbnail->saveAs($thumbPath);

            Image::getImagine()->open($thumbPath)->thumbnail(new Box(1280, 1280))->save();
        }

        return true;
    }


    public function getVideoLink(): string
    {
        return Yii::$app->params['frontendUrl'] . 'storage/videos/' . $this->video_id . '.mp4';
    }

    public function getThumbnailLink(): string
    {
        return Yii::$app->params['frontendUrl'] . 'storage/thumbs/' . $this->video_id . '.jpg';
    }

    public function getStatusAttributeLabels(): array
    {
        return [
            self::STATUS_UNLISTED => 'Unlisted',
            self::STATUS_PUBLISHED => 'Published',
        ];
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $videoPath = Yii::getAlias('@frontend/web/storage/videos/' . $this->video_id . '.mp4');
        $thumbPath = Yii::getAlias('@frontend/web/storage/thumbs/' . $this->video_id . '.jpg');
        unlink($videoPath);
        if (file_exists($thumbPath)) {
            unlink($thumbPath);
        }

    }

    public function getViews()
    {
        return $this->hasMany(VideoView::class, ["video_id" => 'video_id']);
    }

    public function isLikedBy($userId)
    {
        return VideoLikes::find()->userIdVideoId($userId, $this->video_id)->liked()->one();
    }

    public function isDislikedBy($userId)
    {
        return VideoLikes::find()->userIdVideoId($userId, $this->video_id)->disliked()->one();
    }

    public function getLikes()
    {
        return $this->hasMany(VideoLikes::class, ["video_id" => 'video_id'])->liked();
    }
    public function getDislikes()
    {
        return $this->hasMany(VideoLikes::class, ["video_id" => 'video_id'])->disliked();
    }
}
