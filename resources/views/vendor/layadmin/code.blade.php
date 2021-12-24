<x-layadmin::layouts.base>
    <div class="layui-fluid">
        <div class="layui-row layui-col-space10">
            <div class="layui-col-md1">
                <div class="layui-card nav click-but">
                    <div class="layui-card-header">长</div>
                    <div class="layui-card-body">
                        <button class="pear-btn pear-btn-sm" plain data-size="block" data-type="text">输入框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="block" data-type="password">密码框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="block" data-type="select">选择框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="block" data-type="checkbox_a">复选框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="block" data-type="checkbox_b">开关</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="block" data-type="radio">单选框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="block" data-type="textarea">文本域</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="block" data-type="submit">提交</button>
                    </div>
                </div>
                <div class="layui-card nav">
                    <div class="layui-card-header">短</div>
                    <div class="layui-card-body">
                        <button class="pear-btn pear-btn-sm" plain data-size="inline" data-type="text">输入框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="inline" data-type="password">密码框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="inline" data-type="select">选择框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="inline" data-type="checkbox_a">复选框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="inline" data-type="checkbox_b">开关</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="inline" data-type="radio">单选框</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="inline" data-type="textarea">文本域</button>
                        <button class="pear-btn pear-btn-sm" plain data-size="block" data-type="submit">提交</button>
                    </div>
                </div>
                <div class="layui-card nav">
                    <div class="layui-card-body">
                        <button class="pear-btn pear-btn-danger pear-btn-sm del-form" data-type="del"> <i class="layui-icon">&#xe640;</i></button>
                    </div>
                </div>

            </div>
            <div class="layui-col-md5">
                <div class="layui-card content">
                    <div class="layui-card-header">
                        view
                    </div>
                    <div class="layui-card-body code">
                        <form class="layui-form" action="" onsubmit="return false">
                        </form>
                    </div>
                </div>
            </div>
            <div class="layui-col-md6">
                <div class="layui-card r-code-html">
                    <div class="layui-card-header">html</div>
                    <div class="layui-card-body">
                        <textarea name="" class="layui-textarea code-show"></textarea>
                    </div>
                </div>
                <div class="layui-card r-code-js">
                    <div class="layui-card-header">code</div>
                    <div class="layui-card-body">
                        <textarea name="" class="layui-textarea js-show"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layadmin::layouts.base>