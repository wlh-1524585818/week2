<?php

namespace app\api\controller;

use think\Controller;
use think\Loader;
use think\Request;

class Vip extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //接收数据
        $param = input();
//        $where = [];
//        if (!empty($param)){
//            $where['vipname']=['like',"%$param%"];
//        }
        //查询数据
        $data =  \app\api\model\Vip::select();
        return json(['code'=>200,'data'=>$data,'msg'=>'查询成功']);
    }

    /**
     * 会员新增页面
     *
     * @return \think\Response
     */
    public function create()
    {
        //返回新增页面
        return view('add');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //接收数据
        $param = $request->param();
        //书写验证器
        $validate = $this->validate($param,[
            'vipname|用户名'=>'require|unique:vip',
            'vipemail|邮箱'=>'require|email',
            'viptel|电话'=>'require|regex:[1][35789]\d{9}',
        ]);
//        判断是否正确
        if ( $validate !== true){
            return json(['code'=>500,'data'=>'','msg'=>$validate]);
        }
        //进行添加
        $data = \app\api\model\Vip::create($param,true);
        //返回值
        if ($data){
            return json(['code'=>200,'data'=>$data,'msg'=>'添加成功']);
        }{
        return json(['code'=>500,'data'=>'','msg'=>'服务器繁忙']);
    }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //检测id是否正确
        if (!is_numeric($id)||$id<=0) {
            return json(['code' => 500, 'data' => '', 'msg' => '参数格式不正确']);
        }
        //进行查询
        $data = model('vip')->find($id);
        return json(['code'=>200,'data'=>$data,'msg'=>'']);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //检测id是否正确
        if (!is_numeric($id)||$id<=0) {
            return json(['code' => 500, 'data' => '', 'msg' => '参数格式不正确']);
        }
        //接收数据
        $param = $request->param();
        //书写验证器
        $validate = $this->validate($param,[
            'vipname|用户名'=>'require|unique:vip',
            'vipemail|邮箱'=>'require|email',
            'viptel|电话'=>'require|regex:[1][35789]\d{9}',
        ]);
//        判断是否正确
        if ( $validate !== true){
            return json(['code'=>500,'data'=>'','msg'=>$validate]);
        }
        //进行添加
        $data = \app\api\model\Vip::update($param,['id'=>$id]);
        //返回值
        if ($data){
            return json(['code'=>200,'data'=>$data,'msg'=>'修改成功']);
        }{
        return json(['code'=>500,'data'=>'','msg'=>'服务器繁忙']);
    }
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //检测id是否正确
        if (!is_numeric($id)||$id<=0) {
            return json(['code' => 500, 'data' => '', 'msg' => '参数格式不正确']);
        }
        //查询这条数据是否在
        $res = model('vip')->find($id);
        if ($res){
            //进行删除
            $data = model('vip')->where('id',$id)->delete();
            if ($data){
                return json(['code' => 200, 'data' => '', 'msg' => '删除成功']);
            }
        }else{
            return json(['code' => 500, 'data' => '', 'msg' => '不存在该条数据']);
        }
    }
}
