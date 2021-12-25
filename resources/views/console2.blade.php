<x-layadmin::layouts.base class="pear-container">
    <div class="layui-row layui-col-space10">
        <div class="layui-col-md8">
            <div class="layui-row layui-col-space10">
                <div class="layui-col-md6">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            快捷菜单
                        </div>
                        <div class="layui-card-body">
                            <div class="layui-row layui-col-space10">
                                <div class="layui-col-md3 layui-col-sm3 layui-col-xs3">
                                    <div class="pear-card" data-id="home1" data-title="主页"
                                         data-url="http://www.baidu.com">
                                        <i class="layui-icon layui-icon-home"></i>
                                    </div>
                                    <span class="pear-card-title">主页</span>
                                </div>
                                <div class="layui-col-md3 layui-col-sm3 layui-col-xs3">
                                    <div class="pear-card" data-id="home2" data-title="弹层"
                                         data-url="http://www.baidu.com">
                                        <i class="layui-icon layui-icon-camera"></i>
                                    </div>
                                    <span class="pear-card-title">弹层</span>
                                </div>
                                <div class="layui-col-md3 layui-col-sm3 layui-col-xs3">
                                    <div class="pear-card" data-id="home2" data-title="聊天"
                                         data-url="http://www.baidu.com">
                                        <i class="layui-icon layui-icon-star"></i>
                                    </div>
                                    <span class="pear-card-title">聊天</span>
                                </div>
                                <div class="layui-col-md3 layui-col-sm3 layui-col-xs3">
                                    <div class="pear-card" data-id="home3" data-title="相机"
                                         data-url="http://www.baidu.com">
                                        <i class="layui-icon layui-icon-camera"></i>
                                    </div>
                                    <span class="pear-card-title">相机</span>
                                </div>
                                <div class="layui-col-md3 layui-col-sm3 layui-col-xs3">
                                    <div class="pear-card" data-id="home4" data-title="表单"
                                         data-url="http://www.baidu.com">
                                        <i class="layui-icon layui-icon-console"></i>
                                    </div>
                                    <span class="pear-card-title">表单</span>
                                </div>
                                <div class="layui-col-md3 layui-col-sm3 layui-col-xs3">
                                    <div class="pear-card" data-id="home5" data-title="安全"
                                         data-url="http://www.baidu.com">
                                        <i class="layui-icon layui-icon-auz"></i>
                                    </div>
                                    <span class="pear-card-title">安全</span>
                                </div>
                                <div class="layui-col-md3 layui-col-sm3 layui-col-xs3">
                                    <div class="pear-card" data-id="home6" data-title="公告"
                                         data-url="http://www.baidu.com">
                                        <i class="layui-icon layui-icon-cart"></i>
                                    </div>
                                    <span class="pear-card-title">公告</span>
                                </div>
                                <div class="layui-col-md3 layui-col-sm3 layui-col-xs3">
                                    <div class="pear-card" data-id="home7" data-title="更多"
                                         data-url="http://www.baidu.com">
                                        <i class="layui-icon layui-icon-app"></i>
                                    </div>
                                    <span class="pear-card-title">更多</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="layui-card">
                        <div class="layui-card-header">
                            代办任务
                        </div>
                        <div class="layui-card-body">
                            <div class="layui-row layui-col-space10">
                                <div class="layui-col-md6 layui-col-sm6 layui-col-xs6">
                                    <div class="pear-card2">
                                        <div class="title">待审评论</div>
                                        <div class="count pear-text">21</div>
                                    </div>
                                </div>
                                <div class="layui-col-md6 layui-col-sm6 layui-col-xs6">
                                    <div class="pear-card2">
                                        <div class="title">待审帖子</div>
                                        <div class="count pear-text">32</div>
                                    </div>
                                </div>
                                <div class="layui-col-md6 layui-col-sm6 layui-col-xs6">
                                    <div class="pear-card2">
                                        <div class="title">待审文章</div>
                                        <div class="count pear-text">14</div>
                                    </div>
                                </div>
                                <div class="layui-col-md6 layui-col-sm6 layui-col-xs6">
                                    <div class="pear-card2">
                                        <div class="title">待审用户</div>
                                        <div class="count pear-text">63</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md12">
                    <div class="layui-card">
                        <div class="layui-card-body">
                            <div class="layui-tab custom-tab layui-tab-brief" lay-filter="docDemoTabBrief">
                                <div id="echarts-records" style="background-color:#ffffff;min-height:400px;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-card">
                        <div class="layui-card-header">
                            使用记录
                        </div>
                        <div class="layui-card-body">
                            <table id="role-table" lay-filter="role-table"></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-md4">
            <div class="layui-card">
                <div class="layui-card-header">留言板</div>
                <div class="layui-card-body">
                    <ul class="pear-card-status">
                        <li>
                            <p>要不要作为我的家人，搬来我家。</p>
                            <span>12月25日 19:92</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        <li>
                            <p>快乐的时候不敢尽兴，频繁警戒自己保持清醒。</p>
                            <span>4月30日 22:43</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        <li>
                            <p>夏天真的来了，尽管它还有些犹豫。</p>
                            <span>4月30日 22:43</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        <li>
                            <p>看似不可达到的高度，只要坚持不懈就可能到达。</p>
                            <span>4月30日 22:43</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        <li>
                            <p>当浑浊变成了一种常态，那么清白就成了一种罪过。</p>
                            <span>4月30日 22:43</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        <li>
                            <p>那是一种内在的东西，他们到达不了，也无法触及！</p>
                            <span>5月12日 01:25</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        </li>
                        <li>
                            <p>希望是一个好东西,也许是最好的,好东西是不会消亡的！</p>
                            <span>6月11日 15:33</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        <li>
                            <p>一切都在不可避免的走向庸俗。</p>
                            <span>2月09日 13:40</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        <li>
                            <p>路上没有灯火的时候，就点亮自己的头颅。</p>
                            <span>3月11日 12:30</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>

                        <li>
                            <p>我们应该不虚度一生，应该能够说：＂我已经做了我能做的事。＂</p>
                            <span>4月30日 22:43</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        </li>
                        <li>
                            <p>接近，是我对一切的态度，是我对一切态度的距离</p>
                            <span>6月11日 15:33</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                        <li>
                            <p>没有锚的船当然也可以航行，只是紧张充满你的一生。</p>
                            <span>2月09日 13:40</span>
                            <a href="javascript:;" data-id="1" class="pear-btn pear-btn-primary pear-btn-xs pear-reply">回复</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layadmin::layouts.base>