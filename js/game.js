
(function(window,undefined){
    /**
     * 初始化遊戲
     */
    var fruitGame = function(args){
        /*十二種藥材*/
        this.FruitList = [
            // { ID:'F1', FruitName:'香蕉',Icon:'images/b-fruit/banana.png',Cent:50 },
            { ID:'F2', FruitName:'山茱萸',Icon:'./images/herb01.svg',Cent:50 },
            { ID:'F3', FruitName:'菊花',Icon:'./images/herb02.svg',Cent:50 },
            { ID:'F4', FruitName:'薰衣草',Icon:'./images/herb03.svg',Cent:30 },
            { ID:'F5', FruitName:'檸檬',Icon:'./images/herb04.png',Cent:30 },
            { ID:'F6', FruitName:'蒜頭',Icon:'./images/herb05.png',Cent:50 },
            { ID:'F7', FruitName:'生薑',Icon:'./images/herb06.png',Cent:30 },
            { ID:'F8', FruitName:'佛手柑',Icon:'./images/herb07.png',Cent:20 },
            { ID:'F9', FruitName:'八角',Icon:'./images/herb08.png',Cent:10 },
            { ID:'F10', FruitName:'枸杞',Icon:'./images/herb09.png',Cent:10 }
        ];
        /*兩顆炸彈*/
        this.BombList = [
            { ID:'B1',BombName:'土雷',Icon:'./images/user_icon02.png',Life:40 },
            { ID:'B2',BombName:'導弹',Icon:'./images/user_photo02.png',Life:40 }
        ];
        /*關卡等级*/
        this.LevelList = [
            { Level:1,Cent:1000,Speed:1000 }
        ];
        /*生成藥材炸弹的全局引用*/
        this.BuilderFruit = null;
        /*藥材炸弹往下移动的全局引用*/
        this.FruitMove = null;
        /*全局参数设置*/
        this.Setting = $.extend({
            //遊戲盒子
            GameBox:$('div#game_box'),
            //澡盆
            CarBox:$('div#carBox'),
            //澡盆移动像素
            CarMoveWidth:150,
            //藥材籃寬度
            CarBoxWidth:$('div#carBox').width(),
            //遊戲盒宽度 //1920
            BoxWidth:$(window).width(),
            //遊戲盒高度 //500
            BoxHeight:$(window).height(),
            //藥材寬度
            FruitWidth:80,
            //當前總得分
            CountCent:0,
            //關卡级别
            LevelNum:1,
            //關卡卡级别-升级監聽变量
            ListenerLevelNum:1,
            //玩家姓名
            // UserName:'湯先生',
            //玩家总血量
            LifeSize:80,
            //是否暂停
            Pause:false,
            //是否开始
            Start:false
        },args);
    }

    //var car = document.getElementById("carBox");
    /**
     * 遊戲等級對象,改寫只有一關
     */
    fruitGame.prototype.GetLevelModel = function(level){
        var _levels = this.LevelList,
            _levelObj;
        for(var i = 0, _count = _levels.length; i < _count; i++){
            _levelObj = _levels[i];
            if(_levelObj.Level == level)
                return _levelObj;
        }
        return undefined;
    }

    /**
     * 隨機獲得藥材類型
     */
    fruitGame.prototype.GetRandomFruit = function(){
       var _this = this,
           _fruitCount = 0,
           _fruitIndex = 0,
           _fruitList = _this.FruitList.concat(_this.BombList);
        _fruitCount = _fruitList.length;
        _fruitIndex = parseInt(Math.random() * _fruitCount);
        return _fruitList[_fruitIndex];
    }

    /**
     * 監聽遊戲等級
     */
    fruitGame.prototype.GameLevelListener = function(){
        var _this = this,
            _countCent = _this.Setting.CountCent,
            _levelList = _this.LevelList,
            _levelObj;
        for(var i = 0,_count = _levelList.length; i < _count; i++){
            _levelObj = _levelList[i];
            if(_levelObj.Cent >= _countCent){
                if(_levelObj.Level > _this.Setting.ListenerLevelNum){
                    _this.Setting.ListenerLevelNum = _levelObj.Level;
                    _this.ShowUpgrade(_levelObj.Level);
                }
                $('#gameLevel').text(_levelObj.Level);
                _this.Setting.LevelNum = _levelObj.Level;
                break;
            }
        }
    }

    /**
     * @type 
     * @position object { X:0,Y:0 }
     */
    fruitGame.prototype.ShowTipBox = function(type,position){
        var _this = this,
            _tipBoxID = Math.random().toString().replace('.',''),
            _tipBox = '<i id="'+ _tipBoxID +'" class="tip_box '+ type +'" style=" left:' + position.X + 'px; top:' + position.Y + 'px;"></i>';
        _this.Setting.GameBox.append(_tipBox);
        setTimeout(function(){
            $('#' + _tipBoxID).remove();
        },300);
    }

    /**
     * 升级提示框
     * @level int 等级
     */
    // fruitGame.prototype.ShowUpgrade = function(level){
    //     var _this = this,
    //         _tipBox = '<span class="upgrade_tip">第'+ level +'关,加油！</span>';
    //     _this.Setting.GameBox.append(_tipBox);
    //     setTimeout(function(){
    //         $('span.upgrade_tip').remove();
    //     },2000);
    // }

    /**
     * 控制藥材籃左右移動
     */
    
    fruitGame.prototype.BindControlMove = function(){
        var _this = this;
        $(window).keydown(function(e){
            var _code = e.keyCode;
            //左鍵
            if(_code == 37)
                _this.CarBoxMove('left');
            $('#carBox').css("background-image", "url(./images/game_monkey02.svg)");
            //右鍵
            if(_code == 39)
                _this.CarBoxMove('right');
        });
    }

// 手機模式
    //  使用陀螺儀
    if(window.screen.width<1440){
        $('#game_control_txt').text('請將手機改成橫式，左右搖擺移動猴子');
        var mql = window.matchMedia('(orientation: portrait)');
        console.log(mql);
        //判斷手機是直式或橫式
        function handleOrientationChange(mql) {
            if(mql.matches) {
            // 豎屏
                console.log('portrait'); 
                if(window.DeviceOrientationEvent) {
                    console.log($('div#carBox').width());
                    $('div#carBox').css({ left:window.screen.width+ $('div#carBox').width()/2 });
                    window.addEventListener('deviceorientation', function(event) {
                        var gamma = event.gamma;

                        $('div#carBox').css({ left:(gamma*6+400) + 'px' });
                        
                    }, false);
                }else{
                    // document.querySelector('body').innerHTML = '你的瀏覽器不支援喔';
                }
            }else {
             // 橫屏
                console.log('landscape');
                if(window.DeviceOrientationEvent) {
                    console.log($('div#carBox').width());
                    $('div#carBox').css({ left:window.screen.width+ $('div#carBox').width()/2 });
                    window.addEventListener('deviceorientation', function(event) {
                        var beta = event.beta;

                        $('div#carBox').css({ left:(beta*10+400) + 'px' });
                        
                    }, false);
                }else{
                    document.querySelector('body').innerHTML = '你的瀏覽器不支援喔';
                }
            }

        }
// 列印日誌
handleOrientationChange(mql);
// 監聽螢幕模式的變化
mql.addListener(handleOrientationChange);


    //手機橫式
        function changeOrientation($print) {  
            var width = document.documentElement.clientWidth;
            var height =  document.documentElement.clientHeight;
            if(width < height) {
                $print.width(height);
                $print.height(width);
                $print.css('top',  (height - width) / 2 );
                $print.css('left',  0 - (height - width) / 2 );
                $print.css('transform', 'rotate(90deg)');
                $print.css('transform-origin', '50% 50%');
            } 
           
            var evt = "onorientationchange" in window ? "orientationchange" : "resize";
                
                window.addEventListener(evt, function() {
          
                setTimeout(function() {
                    var width = document.documentElement.clientWidth;
                    var height =  document.documentElement.clientHeight;
                    // 刷新城市的宽度
                    initCityWidth();
                    // 初始化每个气泡和自行车碰撞的距离
                    cityCrashDistanceArr = initCityCrashDistance();
              
                //   if( width > height ){
                //       $print.width(width);
                //       $print.height(height);
                //       $print.css('top',  0 );
                //       $print.css('left',  0 );
                //       $print.css('transform' , 'none');
                //       $print.css('transform-origin' , '50% 50%');
                //    }
                //    else {
                    $print.width(height);
                      $print.height(width);
                      $print.css('top',  (height-width)/2 );
                      $print.css('left',  0-(height-width)/2 );
                      $print.css('transform' , 'rotate(90deg)');
                      $print.css('transform-origin' , '50% 50%');
                //    }
              }, 300);  
             }, false);
            }
    }






    /**
     * 澡盆位置
     */
    fruitGame.prototype.CarBoxMove = function(action){
        var _this = this,
            _setting = _this.Setting,
            _left = _setting.CarBox.position().left;
        if(action == 'left'){
            _left = _left - _setting.CarMoveWidth;
            if(_left < 0) return;
            $('div#carBox').css({ left:_left + 'px' });
        }
        if(action == 'right'){
            if(_left >  _setting.BoxWidth - _setting.CarBoxWidth) return;
            _left = _left + _setting.CarMoveWidth;
            $('div#carBox').css({ left:_left + 'px' });
        }
    }

    /**
     * 生成藥材的X位置
     */
    fruitGame.prototype.BuilderFruitPosition = function(){
        var _setting = this.Setting,
            _left = parseInt(Math.random() * _setting.BoxWidth);
        return _left > _setting.BoxWidth - _setting.FruitWidth ? _setting.BoxWidth - _setting.FruitWidth : _left;
    }

    /**
     * 控制藥材落下
     */
    fruitGame.prototype.FruitDownMove = function(element){
        var _this = this,
            _setting = this.Setting;
        var _move = setInterval(function(){
            var _$element = $(element),
                 _top = _$element.position().top;
            _$element.css({ top:(_top + _setting.FruitWidth) + 'px' });
            _this.FruitPutCount(_$element,_move);
        },this.GetLevelModel(_setting.LevelNum).Speed /3 );
        // 控制速度
    }

 
    /**
     * 藥材爆炸後,抖動畫面
     */
    fruitGame.prototype.FruitBombShock = function(){
        var _this = this,
            _$gameBox = _this.Setting.GameBox.parent(),
            _x = _$gameBox.position().left,
            _y = _$gameBox.position().top,
            _shockWidth = 5,
            _shockHeight = 1,
            _shockCount = 0;
        var _shock = setInterval(function(){
            if(_shockCount >= 10){
                _$gameBox.css({ left:_x + 'px', top:_y + 'px'});
                clearInterval(_shock);
                return;
            }
            if(_shockCount % 2 == 0)
                _$gameBox.css({ left:_x + _shockWidth + 'px', top:_y + _shockHeight + 'px'});
            else
                _$gameBox.css({ left:_x - _shockWidth + 'px', top:_y - _shockHeight + 'px'});
            _shockCount++;
        },20);
    }
    
    /**
     * 藥材炸弹,血量减少
     */
    fruitGame.prototype.FruitBomb = function(life){
        var _this = this,
            _$lifeBar = $('#lifeBar'),
            _lifeSize = _$lifeBar.width();
            _lifeSize -= life;
        var score=document.getElementsByClassName('game_over_tip')[0];
        var num = document.getElementById("divNum");

        var xhr = new XMLHttpRequest();
        
        xhr.onreadystatechange = function(){
         if( xhr.readyState == 4){
          if( xhr.status == 200 ){
                
                var discount = JSON.parse(xhr.responseText);
                console.log(discount);
                
                
                if(_lifeSize <= 0 ){

                        // 生命值小於零遊戲結束字樣
                        num.innerHTML="Over!";
                        clearInterval(_this.BuilderFruit);
                        clearInterval(time);
                        document.getElementById("count_back").style.marginTop="-22px";
                        document.getElementById("divNum").style.color="#790e0e";
                        document.getElementById("timeBack").style.display="none";
                        document.getElementById("clock_circle").style.display="none";

                        _$lifeBar.animate({width:_lifeSize + 'px'},100,function(){
                        $('div.thing').remove();
                        aa = parseInt(document.getElementById('gameCent').innerText);
                        // 把文字轉成數值再來判斷
                        // alert(aa);
                        
                        var cpCount=0;
                        if(aa <= 150){
                            c = discount[0].couponName;
                            cpCount=2;
                            d=discount[0].couponNo;
                        }else if(aa <= 200){
                            c = discount[1].couponName;
                            cpCount=1;
                            d=discount[1].couponNo;
                        }else{
                            c = discount[2].couponName;
                            d=discount[2].couponNo;
                        }
                        console.log(`cpCount:${cpCount}, d:${d}`);
                        score.innerHTML=`恭喜您得到積分${document.getElementById('gameCent').innerText}分<br>獲得優惠券!`;
                        document.getElementsByClassName("coupon_discount_score")[0].innerHTML=c;

                        // var date =new Date();
                        // DateStr = date.getFullYear()+ "-"+date.getMonth()+"-"+date.getDate();
                        


                        $('#tip_wrap').css("display" , 'block');
                        
                        //遊戲結束後寫入資料庫
                        var xhr = new XMLHttpRequest();
                        // xhr.onload=function (){
                            var url = `php/memCoupon.php?couponNo=${d}`; //已經預設的欄位不要填寫
                            xhr.open("Get", url, true);
                            xhr.send( null );
                            console.log(xhr);
                        // } 
                    });
                    clearInterval(this.BuilderFruit);
                    
                }else{
                    _$lifeBar.animate({width:_lifeSize + 'px'},100,function(){
                        if(_lifeSize <= _this.Setting.LifeSize / 1.5){
                            _$lifeBar.removeAttr('class').addClass('yellow');}
                        if(_lifeSize <= _this.Setting.LifeSize / 2){
                            _$lifeBar.removeAttr('class').addClass('red');}
                    });
                }
            }else{
                alert( xhr.status );
              }
         }
        }
        var url = "php/coupon.php";
        xhr.open("Get", url, true);
        xhr.send( null );
    }


    /**
     * 計算籃子接到的藥材
     */
    fruitGame.prototype.FruitPutCount = function(element,elementMove){
        var _this = this,
            _setting = _this.Setting,
            _carBoxLeft = _setting.CarBox.position().left,
            _carBoxTop = _setting.CarBox.parent().position().top,
            _elTop = element.position().top + element.height(),
            _elLeft = element.position().left + element.width(),
            _fruitCent = parseInt(element.attr('cent') || 0),
            _life = element.attr('life');

        if(_elLeft >= _carBoxLeft && _elLeft - element.width() <= _carBoxLeft + _setting.CarBoxWidth && _elTop - 50 >= _carBoxTop){
            clearInterval(elementMove);
            element.remove();

            if(typeof _life == 'undefined'){
                //console.log('A:' + _life + ' - ' + (typeof _life == 'undefined') + ' - ' + _fruitCent);
                _setting.CountCent += _fruitCent;
                $('#gameCent').text(_setting.CountCent);
                // console.log($('#gameCent').text(_setting.CountCent));
                _this.GameLevelListener();
                _this.ShowTipBox('kiss',{ X:_elLeft - _setting.FruitWidth, Y: _elTop - 30 });
            }else{
                //console.log('B:' + _life);
                _this.FruitBomb(_life);
                _this.ShowTipBox('bomb',{ X:_elLeft - _setting.FruitWidth - 20, Y: _elTop - 60 });
                _this.FruitBombShock();
            }
        }else if(_elTop - 60 > _carBoxTop){
            clearInterval(elementMove);
            element.remove();
            _this.ShowTipBox('miss',{ X:_elLeft - _setting.FruitWidth, Y: _elTop - 60 });
        }
    }

    /**
     * 開始遊戲
     */
    fruitGame.prototype.Start = function(){
        var _this = this,
            _$lifeBar = $('#lifeBar'),
            _lifeSize = _$lifeBar.width();
       // 倒數二十秒計時器
        var num = 15;
        time = setInterval(bye,1000); 

        // var _$lifeBar = $('#lifeBar'),
        //     _lifeSize = _$lifeBar.width();
        // 用innerHTML來更改數字


        // 寫下一個數字 就會是10的-3次方,所以寫1000會等於一秒	
        // 倒數三十秒計時器結束 
        
        
        var _this = this,
            _setting = this.Setting;
        // 遊戲部分
        _this.BindControlMove();
        _this.BuilderFruit = setInterval(function(){
            var _domDiv = document.createElement('div'),
                _fruitObj = _this.GetRandomFruit();
            _domDiv.setAttribute('class','thing');
            _domDiv.setAttribute('idx',_fruitObj.ID);
            if(_fruitObj.Life){
                _domDiv.setAttribute('life',_fruitObj.Life);
            }else{
                _domDiv.setAttribute('cent',_fruitObj.Cent);
            }
            _domDiv.setAttribute('style','left:' + _this.BuilderFruitPosition() + 'px;');
            _domDiv.innerHTML = '<img src="'+ _fruitObj.Icon +'" width="30" height="30"/>';
            _setting.GameBox.append(_domDiv);
            _this.FruitDownMove(_domDiv);
        },
        _this.GetLevelModel(_setting.LevelNum).Speed);


        // 這邊寫一個遊戲本身停止的計時器
        // 30000毫秒過後執行吃到炸彈的function，這function是給生命life，要扣多少就給多少，滿是80，所以可以給80，這裡給100
        // var clock;
        var clock;

        
        clock=setTimeout(function() {
         clearInterval(_this.BuilderFruit);
        // console.log(fruitGame.prototype.FruitBomb(100));
        }, 15000);
       
        
        function bye(){
            num--;
             if(num == 0 ){ 
            num = "時間到!";
            // 到這邊取消計時器標號
             clearInterval( time );
             document.getElementById("count_back").style.marginTop="-22px";
             document.getElementById("divNum").style.color="#790e0e";
             document.getElementById("timeBack").style.display="none";  
             //  console.log(fruitGame.prototype.FruitBomb(100));
             document.getElementById("divNum").innerHTML= num ;
            //  clearTimeout(clock);
            //  clearInterval(_this.BuilderFruit);
            clearInterval(_this.BuilderFruit);
            console.log(fruitGame.prototype.FruitBomb(100));
             
           }else if(_lifeSize <= 0){
            clearTimeout(clock);
            clearInterval(_this.BuilderFruit);
            num = "OVER!";

           }
               
       console.log(num);
       document.getElementById("divNum").innerHTML= num ;
       
   }

        return this;
    }

    /**
     * 遊戲初始化
     */
    fruitGame.prototype.Init = function(){
        var _this = this;
        //new fruitGame().Start();
    }

    window.FruitGame = function(){
        return new fruitGame();
    }();
})(window);



