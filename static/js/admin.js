BUI.use('common/main',function(){
    var config = [{
        id:'menu',
        homePage : 'code',
        menu:[{
            text:'管理员管理',
            items:[
                {id:'code',text:'查询管理员',href:'index.php?m=admin&f=member',closeable : false},
                {id:'code1',text:'添加管理员',href:'index.php?m=admin&f=member&a=addMember',closeable : false},
            ]
        },{
            text:'管理员角色',
            items:[
                {id:'operation',text:'设置管理员角色',href:'index.php?m=admin&f=member&a=showRole'},
            ]
        }]
    },{
        id:'form',
        menu:[{
            text:'用户管理',
            items:[
                {id:'code',text:'查看用户',href:'index.php?m=admin&f=index&a=showUser'},
                {id:'example',text:'添加用户',href:'index.php?m=admin&f=index&a=addUser'},
            ]
        },{
            text:'用户角色管理',
            items:[
                {id:'success',text:'设置用户角色',href:'index.php?m=admin&f=userRole&a=selectUserRole'},
                {id:'fail',text:'添加用户角色',href:'index.php?m=admin&f=userRole&a=addUserRole'}
            ]
        }]
    },{
        id:'search',
        menu:[{
            text:'分类管理',
            items:[
                {id:'code',text:'查看分类',href:'index.php?m=admin&f=cate&a=seeCate'},
                {id:'example',text:'添加分类',href:'index.php?m=admin&f=cate&a=addCate'},
            ]
        },{
            text : '内容管理',
            items : [
                {id : 'tab5',text : '内容管理',href : 'index.php?m=admin&f=content&a=showCon'},
            ]
        },{
            text : '留言管理',
            items : [
                {id : 'tab3',text : '查询留言',href : ''},
                {id : 'tab4',text : '添加留言',href : ''},
            ]
        },{
            text : '推荐位管理',
            items : [
                {id : 'tab',text : '查询推荐位',href : 'index.php?m=admin&f=cate&a=showPos'},
                {id : 'tab1',text : '添加推荐位',href : 'index.php?m=admin&f=cate&a=addPos'},
            ]
        }]
    },{
        id:'detail',
        menu:[{
            text:'留言管理',
            items:[
                {id:'code',text:'查看留言',href:'detail/code.html'},
                {id:'example',text:'编辑留言',href:'detail/example.html'},
            ]
        }]
    },{
        id : 'chart',
        menu : [{
            text : '图表',
            items:[
                {id:'code',text:'引入代码',href:'chart/code.html'},
                {id:'line',text:'折线图',href:'chart/line.html'},
                {id:'area',text:'区域图',href:'chart/area.html'},
                {id:'column',text:'柱状图',href:'chart/column.html'},
                {id:'pie',text:'饼图',href:'chart/pie.html'},
                {id:'radar',text:'雷达图',href:'chart/radar.html'}
            ]
        }]
    }];
    new PageUtil.MainPage({
        modulesConfig : config
    });
});