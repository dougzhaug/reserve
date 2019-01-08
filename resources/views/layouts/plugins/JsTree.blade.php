@push('link')
    <!-- js_tree css -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.3/themes/default/style.min.css">
@endpush

<div id="js-tree"></div>

{{--存储用于jstree展示所需的id--}}
<input type="hidden" id="js_tree_ids" name="{{$tree_ids or 'js_tree_ids'}}" value="">

{{--存储带有半选状态的id--}}
@if($name)
    <input type="hidden" id="{{$name}}" name="{{$name}}" value="">
@endif

@push('script')

    <script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.3/jstree.min.js"></script>

    <script>
        $(function() {

            $('#js-tree').jstree({
                'core' : {
                    "data" : {
                        "url" : '{{$url}}',
                        "type" : "POST",
                        "dataType" : "json",
                        "headers" : { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                    }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "types" : {
                    "default" : {
                        "icon" : "{{$default_icon or 'fa fa-info-circle'}}"
                    }
                },
                "plugins" : [ "checkbox","types"]
            });
        });

        /**
         * 默认jstree所需数据
         */
        $('#js-tree').on('changed.jstree',function(e,data){
            var permissions = $(this).jstree(true).get_selected(false);

            $('#js_tree_ids').val(permissions);
        });

        /**
         * 获取包含半选状态的所有id并赋值给隐藏域
         *
         * @returns {boolean}
         */
        function getContainUndetermined() {
            var permission = $('#js-tree').jstree(true).get_selected(false);
            var permissions = permission.toString();
            permissions = getUnd(permissions);
            $("#{{$name}}").val(permissions);
        }

        /**
         * 获取所有半选状态的复选框id
         *
         * @param permissions
         * @returns {*}
         */
        function getUnd(permissions){
            $(".jstree-undetermined").each(function(){
                permissions = permissions + ',' + $(this).parent().parent().attr('id');
            });
            return permissions;
        }
    </script>
@endpush

{{--  使用说明

    必传参数
    name = 'switch'                                 //switch开关name     [String]

    选传参数
    checked = false                                 //选中状态 false关闭(默认) true开启
    disabled = false                                //是否可用 false可用(默认) true不可用
    color = '#13dafe'                               //开启状态的颜色
    secondary_color = ''                            //关闭状态的颜色
    size = ''                                       //开关大小  small小号  ''中号(默认)  large大号

--}}
