<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    //  链接表名
    protected $table = "jy_comment";

    const
        GOODS_TYPE = 1, //  商品评论
        END        = true;


    /**
     * @desc  商品评论列表
     * @param array $where
     * @return mixed
     */
    public function getCommentList($where = [])
    {

        $comment = self::select('jy_comment.id','goods_name','username','jy_user.image_url','jy_comment.content')
                       ->leftJoin('jy_goods','jy_comment.comment_id','=','jy_goods.id')
                       ->leftJoin('jy_user','jy_comment.user_id','=','jy_user.id')
                       ->where('type', self::GOODS_TYPE)
                       ->where($where)
                       ->orderBy('jy_comment.id','desc')
                       ->paginate(5);

        return $comment;

    }

}
