BUI.use(['bui/grid','bui/data'],function(Grid,Data){
    var Grid = Grid,
        Store = Data.Store,
        enumObj = {"1" : "增","2" : "删","3" : "改","4" : "查"},
        columns = [
            {title : 'lid',dataIndex :'lid'}, //editor中的定义等用于 BUI.Form.Field.Text的定义
            {title : '管理员角色', dataIndex :'lname'},
            {title : '留言权限',dataIndex : 'messagenum',renderer : Grid.Format.multipleItemsRenderer(enumObj)},
            {title : '内容权限',dataIndex : 'connum',renderer : Grid.Format.multipleItemsRenderer(enumObj)},
            {title : '管理员权限',dataIndex : 'adminnum',renderer : Grid.Format.multipleItemsRenderer(enumObj)},
            {title : '操作',renderer : function(){
                return '<span class="grid-command btn-edit">编辑</span>'
            }}
        ];
    var isAddRemote = false,
        editing = new Grid.Plugins.DialogEditing({
            contentId : 'content', //设置隐藏的Dialog内容
            triggerCls : 'btn-edit', //触发显示Dialog的样式
            editor : {
                title : '管理员角色',
                width : 600,
                success:function(){
                    var editor=this;
                    form=editor.get("form");
                    form.valid();

                    var type=editing.get("editType");   //add 或者 edit
                    if(form.isValid()){
                        form.ajaxSubmit({
                            url:"index.php?m=admin&f=member&a=addRole&type="+type,
                            data:form.serializeToObject(),
                            dataType:"text",
                            type:"post",
                            success:function(e){
                                if(e){
                                    form.setFieldValue("lid",e);     //
                                    editor.accept();
                                }
                            }
                        })
                    }

                }
            }
        }),
        store = new Store({
            url : "index.php?m=admin&f=member&a=selectRole",
            autoLoad:true
        }),
        grid = new Grid.Grid({
            render:'#grid',
            columns : columns,
            width : 700,
            forceFit : true,
            tbar:{ //添加、删除
                items : [{
                    btnCls : 'button button-small',
                    text : '<i class="icon-plus"></i>添加',
                    listeners : {
                        'click' : addFunction
                    }
                },
                    {
                        btnCls : 'button button-small',
                        text : '<i class="icon-remove"></i>删除',
                        listeners : {
                            'click' : delFunction
                        }
                    }]
            },
            plugins : [editing,Grid.Plugins.CheckSelection],
            store : store
        });

    grid.render();

    //添加记录
    function addFunction(){
        var newData = {b : 0};
        editing.add(newData,'a'); //添加记录后，直接编辑
    }
    //删除选中的记录
    function delFunction(){
        var selections = grid.getSelection();
        var data="";
        selections.map(function(e){
            data+=e.lid+",";
        });
        var lids="("+data.slice(0,-1)+")";
        //自己写的ajax
        $.ajax({
            url:"index.php?m=admin&f=member&a=delete",
            type:"post",
            data: {lids},
            success:function(e){
                if(e=="ok"){
                    alert("删除成功");
                    store.remove(selections);
                }else if(e=="no"){
                    alert("您没有权限");
                }
            }

        })
    }
});