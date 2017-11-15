/*
//创建视图
* params object
* params.parent  父容器
* params.selectBtn
* params.upBtn
*
*
* createselector（parent，）

*创建选择按钮
* 创建上传按钮
* 创建玉兰容器
* 选择文件
*
*
*
* */
class upload{
    constructor(){
        this.data=[];
        this.list=[];
        this.parent=parent;
        this.filename="file";
        this.size=1024*1024*88;
        this.type="image/png;image/jpeg;image/gif;image/jpg";
        this.sboxCon="请选择文件";
        this.sboxStyle="width:200px;height:50px;border-radius:5px;background:#ff6700";
        this.upboxStyle="width:200px;height:50px;border-radius:5px;background:#ff6700";
        this.upboxCon="上传";
        this.listStyle="width:100px;height:100px;float:left;border:1px solid #ccc;padding:2px;";
        this.progressStyle="width:100%;height:5px;position:absolute;bottom:0;left:0;";
        this.backStyle="width:0%;height:100%;background:blue;";
        this.errorStyle="width:100%;height:20px;background:rgba(0.0,0,0.8);position:absolute;left:0;right:0;top:0;bottom:0;margin:auto;text-align:center;line-height:20px;";
        this.errorCon="ERROR";
    }
    createView(params){
        //1.创建选择文件按钮
        this.createSelectBtn(params.parent,params.selectBtn,()=>{
            //2.创建预览窗口
            this.createPview();
            //3.创建上传按钮
            this.createUpBtn();
            //4.检查
            this.change();

        })
    }
    //创建选择按钮
    createSelectBtn(parent,selectBtn,callback){
        if(!parent){
            console.error("请指定父元素");
            return false;
        }
        if(selectBtn){
            this.SelectBtn=selectBtn;
        }
        var inp=document.createElement("input");
        inp.type='file';
        inp.name=this.filename;
        this.selectBtn=inp;
        var sbox=document.createElement("div");

        sbox.style.cssText=this.sboxStyle;
        sbox.innerHTML=this.sboxCon;
        sbox.style.textAlign="center";

        this.parent=parent;
        parent.appendChild(sbox);
        sbox.appendChild(inp);
        sbox.style.position='relative';
        sbox.style.lineHeight=sbox.offsetHeight+'px';
        inp.multiple="multiple";
        inp.style.cssText="opacity:0;width:100%;height:100%;position: absolute;top:0;left:0";
        callback();
    }
    createPview(){
        var pview=document.createElement('div');
        pview.style.cssText="width:500px;height:100px;border:1px solid #fff;margin-top:10px;margin-bottom:10px;";
        this.parent.appendChild(pview);
        this.pview=pview;
    }
    createUpBtn(){
        var up=document.createElement("input");
        up.type='button';
        this.up=up;
        var upbox=document.createElement("div");
        upbox.style.cssText=this.upboxStyle;
        upbox.innerHTML=this.upboxCon;
        upbox.style.textAlign="center";


        this.parent.appendChild(upbox);
        upbox.appendChild(up);
        upbox.style.position='relative';
        upbox.style.lineHeight=upbox.offsetHeight+'px';
        up.style.cssText="opacity:0;width:100%;height:100%;position: absolute;top:0;left:0";
    }

    //检查
    change(){
        var that=this;
        that.selectBtn.onchange=function(){
            that.data=Array.prototype.slice.call(this.files);//将含有length属性类似数组的集合转化成数组
            that.check();
        }
    }
    //检查每一项数据
    check(){
        var that=this;
        var temp=[];
        for(var i=0;i<this.data.length;i++){
            temp[i]=this.data[i];
            var obj=that.createList(that.data[i]);
            that.list[i]=obj;
            obj.del.index=i;
            (function(obj){
                obj.list.onmouseenter=function(){
                    obj.del.style.display="block";
                }
                obj.list.onmouseleave=function(){
                    obj.del.style.display="none";
                }
            })(obj);
            //删除
            obj.del.onclick=function(){
                this.parentNode.parentNode.removeChild(this.parentNode);
              var tempdata=temp[this.index];
              for(var i=0;i<that.data.length;i++){
                  if(that.data[i]==tempdata){
                    that.data.splice(i,1);
                    that.list.splice(i,1);
                  }
              }
            };

        //判断文件类型是否符合
        if(this.type.indexOf(this.data[i].type)<0){
            var tempdata=temp[i];
            for(var j=0;j<that.data.length;j++){
                if(that.data[j]==tempdata){
                    that.data.splice(j,1)
                    that.list.splice(j,1)
                }
                obj.error.style.display="block";
                obj.error.innerHTML="类型不对";
            }
        }
        //判断文件大小是否符合
        if(this.data[i]) {
            if (this.size < this.data[i].size) {
                var tempdata = temp[i];

                for (var j = 0; j < that.data.length; j++) {
                    if (that.data[j] == tempdata) {
                        that.data.splice(j, 1);
                        that.list.splice(j,1);
                    }
                }
                obj.error.style.display = "block";
                obj.error.innerHTML = "尺寸太大";
            }
        }
        }
    }
    //上传
    upl(url,callback){
        var that=this;
        this.up.onclick=function(){
            for(var i=0;i<that.data.length;i++){
                var ajax=new XMLHttpRequest();
                var form=new FormData();
                form.append(that.filename,that.data[i]);

                (function(i){
                    var arr=[];
                    ajax.onload=function(){
                        arr.push(ajax.response);
                        if (callback) {
                            callback(arr);
                        }
                    };
                    ajax.upload.onprogress=function(e){
                        var bili =e.loaded/e.total*100+"%";
                        that.list[i].back.style.width=bili;
                    }
                })(i);
                ajax.open("post",url);
                ajax.send(form);
            }
        }
    }
    //创建预览列表
    createList(data){
        var list=document.createElement("div");
        list.style.cssText=this.listStyle;
        list.style.position="relative";

        var read=new FileReader();  //允许Web应用程序异步读取存储在用户计算机上的文件（或原始数据缓冲区）的内容
        read.onload=function(e){
            list.style.background="url(" + e.target.result + ")";
            list.style.backgroundSize="cover";

        };
        read.readAsDataURL(data);
        //进度条容器
        var progress=document.createElement("div");
        progress.style.cssText=this.progressStyle;
        //进度条
        var back=document.createElement("div");
        back.style.cssText=this.backStyle;
        //错误提示
        var error=document.createElement("div");
        error.style.cssText=this.errorStyle;
        error.innerHTML=this.errorCon;
        error.style.display="none";
        //删除
        var del=document.createElement("div");
        del.style.cssText="width:20px;height:20px;position:absolute;right:2px;top:2px;text-align:center;line-height:20px;cursor:pointer;border:1px solid #777;display:none";
        del.innerHTML="X";

        progress.appendChild(back);
        list.appendChild(del);
        list.appendChild(error);
        list.appendChild(progress);
        this.pview.appendChild(list);
        return {
            del:del,
            error:error,
            list:list,
            back:back
        }
    }
}