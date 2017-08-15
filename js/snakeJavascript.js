function Start() {
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var tab = [];
    var tabApple = [];
    tab[1] = [124, 31];
    tab[2] = [93, 31];
    tab[3] = [62, 31];
    tab[4] = [31, 31];
    tab[5] = [0, 31];

    function Snake() {
        var that = this;
        var snakeImg = new Image();
        var snakeFaceDown = new Image();
        var snakeFaceUp = new Image();
        var snakeFaceRight = new Image();
        var snakeFaceLeft = new Image();
        var snakeFace = null;
        snakeImg.src = ('img/snakeBody.png');
        snakeFaceDown.src = ('img/snakeFaceDown.png');
        snakeFaceUp.src = ('img/snakeFaceUp.png');
        snakeFaceRight.src = ('img/snakeFaceRight.png');
        snakeFaceLeft.src = ('img/snakeFaceLeft.png');
        this.snakeEatApple = false;
        this.snakeAlive = true;
        this.snakeLength = 5;
        this.snakeBody = [];
        this.y = 31;
        this.x = 124;
        this.direction = 'right';

        this.anim = function () {
            switch (that.direction) {
                case 'right':
                    that.x += 31;
                    snakeFace = snakeFaceRight;
                    break;
                case 'left':
                    that.x -= 31;
                    snakeFace = snakeFaceLeft;
                    break;
                case 'down':
                    that.y += 31;
                    snakeFace = snakeFaceDown;
                    break;
                case 'up':
                    that.y -= 31;
                    snakeFace = snakeFaceUp;
                    break;
            }

            that.snakeBody[1] = [that.x, that.y];
            for (var i = 1; i <= this.snakeLength; i++) {
                if (i > 1) {
                    that.snakeBody[i] = tab[i - 1];
                }

                //kontrola kolizji - autokanibalizm snake'a kolizja glowy tabKopia[1][0]... z elementem weza      
                if (i > 1 && that.snakeBody[1][0] === that.snakeBody[i][0] && that.snakeBody[1][1] === that.snakeBody[i][1])
                {
                    this.snakeAlive = false;
                }
                if (i === 1)
                {
                    context.drawImage(snakeFace, that.snakeBody[i][0], that.snakeBody[i][1]);
                } else {
                    context.drawImage(snakeImg, that.snakeBody[i][0], that.snakeBody[i][1]);
                }
            }
            for (var i = 1; i <= this.snakeLength; i++) {
                tab[i] = that.snakeBody[i];
            }

        }; //end of anim function

        this.directionSnake = function () {
            window.addEventListener('keydown', function (event) {
                switch (event.keyCode)
                {
                    case 37:
                    case 65:
                        if (that.direction !== 'right')
                            that.direction = 'left';
                        break;

                    case 38:
                    case 87:
                        if (that.direction !== 'down')
                            that.direction = 'up';
                        break;

                    case 39:
                    case 68:
                        if (that.direction !== 'left')
                            that.direction = 'right';
                        break;

                    case 40:
                    case 83:
                        if (that.direction !== 'up')
                            that.direction = 'down';
                        break;
                }
            }, false);
        };

        this.checkAppleColision = function (x, y) {
            this.appleX = x;
            this.appleY = y;
            tabApple[1] = [this.appleX, this.appleY];
            if (that.snakeBody[1][0] === tabApple[1][0] && that.snakeBody[1][1] === tabApple[1][1])
            {
                that.snakeEatApple = true;
                this.snakeLength++;
            }
        };

        this.checkCanvasColision = function () {
            if (that.x < 0 || that.x > 620 - 31 || that.y < 0 || that.y > 620 - 31) {
                return true;
            }
        };
    }//end function Snake

    function Apple() {
        var that = this;
        var appleImg = new Image();
        appleImg.src = 'img/japko.png';
        this.applePos = [];
        this.x = 0;
        this.y = 0;

        this.random = function () {
            this.randomValue = 31 * (Math.floor((Math.random() * 19) + 1));
            return (this.randomValue);
        };
        this.drawApple = function (x, y) {
            this.x = x;
            this.y = y;
            context.drawImage(appleImg, this.x, this.y);
        };
    }//end function Apple
    
    function setCookie(name, val, days) {
        if (days) {
            var data = new Date();
            data.setTime(data.getTime() + (days * 24*60*60*1000));
            var expires = "; expires="+data.toGMTString();
        } else {
        var expires = "";
        }
        document.cookie = name + "=" + val + expires + "; path=/";
        }//end setCookie
        
    function getCookie(name) {
    if (document.cookie !== "") { //jeżeli document.cookie w ogóle istnieje
        var cookies=document.cookie.split("; ");  //tworzymy z niego tablicę ciastek
        for (var i=0; i<cookies.length; i++) { //i robimy po niej pętlę
            var cookieName=cookies[i].split("=")[0]; //nazwa ciastka
            var cookieVal=cookies[i].split("=")[1]; //wartość ciastka
                if (cookieName===name) 
                {
                     return decodeURI(cookieVal); //jeżeli znaleźliśmy ciastko o danej nazwie, wtedy zwracamy jego wartość
                }
            }
        }
        else{
            var nickname = 'username';
            return nickname;
        }
    }//end getCookie

    function Game() {
        var that = this;
        var name = null;
        //var username = getCookie('name');
	this.nickReg = /^[a-zA-Z0-9]{2,15}$/; //wyrazenie regularne
        this.startImage = new Image();
        this.startImage.src = 'img/snake.png';
        this.points = 0;
        this.apple = new Apple();
        this.snake = new Snake();
        this.x = 62;
        this.y = 62;

        this.welcomeGame = function () {
            context.fillStyle = "blue";
            context.font = "50px Times New Roman";
            context.fillText("Witaj w grze Snake!", 120, 100);
            context.fillStyle = "black";
            context.font = "30px Times New Roman";
            context.fillText("- enter - rozpoczęcie gry", 180, 140);
            context.fillText("- sterowanie: WASD + strzałki", 180, 170);
            context.drawImage(this.startImage, 10, 150, 450, 450);

            window.addEventListener('keydown', function (event) {
                switch (event.keyCode)
                {
                    case 13:
                        gra.initGame();
                        break;

                }
            }, false);
        };//end welcomegame

        this.initGame = function () {

            this.intervalGame = setInterval(function () {
                if (that.snake.snakeEatApple === true) {

                    var test = [];
                    that.x = that.apple.random();
                    that.y = that.apple.random();
                    test[1] = [that.x, that.y];

                    var i = 1;
                    while (i !== that.snake.snakeLength)
                    {
                        if (test[1][0] === that.snake.snakeBody[i][0] && test[1][1] === that.snake.snakeBody[i][1]) {
                            that.x = that.apple.random();
                            that.y = that.apple.random();
                            test[1] = [that.x, that.y];
                            i = 1;
                        }
                        i++;
                    }

                    that.points += 10;
                    that.snake.snakeEatApple = false;
                }
                context.clearRect(0, 0, 620, 620);
                that.apple.drawApple(that.x, that.y);
                that.snake.anim();
                that.snake.checkAppleColision(that.x, that.y);
                if (that.snake.checkCanvasColision() === true || that.snake.snakeAlive === false)
                {
                    clearInterval(that.intervalGame);
                    name = getCookie('name'); //sprzwdzam czy nick jest przechowywany w ciasteczku
                    
                    nickName=prompt('Koniec gry, zdobyłeś: '+that.points+' punktów.\nPodaj nick w celu zapisania wyniku(2-15 znaków, litery + cyfry): ', name);// 'username');
                    if(nickName !== null)
                    {
                        if(that.nickReg.test(nickName)) //zastosowanie wyrazenia regularnego
			{
                            name=nickName;
			}
			else
			{
			name="badname";
                        }
                        setCookie('name', name);
                        setCookie('points', that.points);
                        window.location.href= 'wynik';   
                    }
                    else 
                    {
                        clearInterval(that.intervalGame);
                        context.clearRect(0, 0, 620, 620);
                        window.location.reload();

                        gra.welcomeGame();}
                }

                that.snake.directionSnake();
                var elem = document.getElementById("points");
                elem.innerHTML = 'Liczba punktów: '+that.points;
                elem.style.color = "darkblue";
                elem.style.fontSize = "x-large";

            }, 150);

        }; //end init game

    }
    var gra = new Game();
    gra.welcomeGame();
}