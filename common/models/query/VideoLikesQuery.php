<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\VideoLikes]].
 *
 * @see \common\models\VideoLikes
 */
class VideoLikesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\VideoLikes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\VideoLikes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function userIdVideoId($userId, $videoId): VideoLikesQuery
    {
        return $this->andWhere(['user_id' => $userId, 'video_id' => $videoId]);
    }
}
