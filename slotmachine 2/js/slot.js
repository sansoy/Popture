(function($){
	var slotMachine = function() {
		var credits = 0,
			spinning = 3,
			spin = [0,0,0],
			slotsTypes = {
				'ben': [2,5,10],
				'derek': [0,15,30],
				'jaden': [0,40,50],
				'justin': [0,50,80],
				'gaga': [0,0,500],
				'khloe': [0,0,100],
				'kim': [0,0,150],
				'kristen': [0,0,250],
				'mark': [0,0,80],
				'owen': [0,0,80],
				'queen': [0,0,80],
				'simon': [0,0,80],
				'tara': [0,0,80],
				'taylorl': [0,0,80],
				'taylors': [0,0,80]
			},
			slots = [
				['ben','derek','kim','jaden','justin'],
				['khloe','mark','gaga','owen','queen'],
				['taylors','taylorl','simon','tara','kristen'],
			],
			
			startSlot = function() {
				credits = 15;
				spinning = false;
				$('#slotSplash').animate({top: -130}, 1000, 'bounceOut');
				$('#slotTrigger').removeClass('slotTriggerDisabled');
				this.blur();
				return false;
			},
			endSlot = function() {
				$('#slotSplash').animate({top: 0}, 1000, 'bounceOut');
			},
			addCredit = function(incrementCredits) {
				var currentCredits = credits;
				credits += incrementCredits;
				$('#slotCredits')
					.css('credit', 0)
					.animate({
						credit: incrementCredits
					},{
						duration: 400 + incrementCredits,
						easing: 'easeOut',
						step: function (now) {
							$(this).html(parseInt(currentCredits + now, 10));
						},
						complete: function() {
							$(this).html(credits);
						}
					});
			},
			clearQuestion = function() {
				var question = "";
				$('#question').html(question);
			},
			addQuestion = function() {
				var random = Math.floor(Math.random() * 10);

				var question=[	"Who starred in the movie Star Wars?",
						"Who knows President Obama?",
						"Who starred in the movie Something About Mary",
						"Who co-starred with Ben Affleck?",
						"Who's real name is Dana Elaine Owens?",
						"Who starred in the series Beyond The Break?",
						"Who created American Idol?",
						"Which person does Troy Carter manage?",
						"Who was discovered on youtube?",
						"Who can sing and dance?"
					     ];
				$('#question').html(question[random]);
			},
			spin = function() {
				this.blur();
				clearQuestion();
				if (spinning == false) {
					spinning = 3;
					credits --;
					$('#slotCredits').html(credits);
					spin[0] = parseInt(Math.random() * 5);
					spin[1] = parseInt(Math.random() * 5);
					spin[2] = parseInt(Math.random() * 5);
					$('#slotTrigger').addClass('slotTriggerDisabled');
					$('img.slotSpinAnimation').show();
					$('#wheel1 img:first').css('top', - (spin[0] * 200 + 16) + 'px');
					$('#wheel2 img:first').css('top', - (spin[1] * 200 + 16) + 'px');
					$('#wheel3 img:first').css('top', - (spin[2] * 200 + 16) + 'px');
					setTimeout(function(){
						stopSpin(1);
					}, 1500 + parseInt(1500 * Math.random()));
					setTimeout(function(){
						stopSpin(2);
					}, 1500 + parseInt(1500 * Math.random()));
					setTimeout(function(){
						stopSpin(3);
					}, 1500 + parseInt(1500 * Math.random()));
				}
				return false;
			},
			stopSpin = function(slot) {
				$('#wheel' + slot)
					.find('img:last')
						.hide()
						.end()
					.find('img:first')
						.animate({
							top: - spin[slot - 1] * 200 
						},{
							duration: 500,
							easing: 'elasticOut',
							complete: function() {
								spinning --;
								if (spinning == 0 ) {
									endSpin();
								}
							}
						});
			},
			endSpin = function() {
				var slotType = slots[0][spin[0]],
					matches = 1,
					barMatch = /bar/.test(slotType) ? 1 : 0,
					winnedCredits = 0,
					waitToSpin = 10;
				var check = slots[2][spin[2]];
				if ( slotType == slots[1][spin[1]]) {
					matches ++;
					if ( slotType == slots[2][spin[2]]) {
						matches ++;
					} else if (barMatch !=0 && /bar/.test(slots[2][spin[2]])) {
						barMatch ++;
					}
				} else if (barMatch != 0 && /bar/.test(slots[1][spin[1]])) {
					barMatch ++;
					if (/bar/.test(slots[2][spin[2]])) {
						barMatch ++;
					}
				}
				if (matches != 3 && barMatch == 3) {
					slotType = 'anybar';
					matches = 3;
				}
				
				var winnedCredits = slotsTypes[slotType][matches-1];
				winnedCredits = 12		
				if (winnedCredits > 0) {
					addCredit(winnedCredits);
					addQuestion();
					waitToSpin = 410 + winnedCredits;
				}
				setTimeout(function() {
					if (credits == 0) {
						setTimeout(function() {
							endSlot();
						}, 1000);
					} else {
						$('#slotTrigger').removeClass('slotTriggerDisabled');
						spinning = false;
					}
				}, waitToSpin);
			};
		return {
			init: function() {
//				$('#slotSplash a').bind('click', startSlot);
				$('#slotTrigger').removeClass('slotTriggerDisabled');
				credits = 15;
				spinning = false;
				$('#slotTrigger')
					.bind('mousedown', function(){
						$(this).addClass('slotTriggerDown');
					})
					.bind('click', spin);
				$(document).bind('mouseup', function(){
					$('#slotTrigger').removeClass('slotTriggerDown');
				});
				$('#wheel1 img:first').css('top', - (parseInt(Math.random() * 5) * 200) + 'px');
				$('#wheel2 img:first').css('top', - (parseInt(Math.random() * 5) * 200) + 'px');
				$('#wheel3 img:first').css('top', - (parseInt(Math.random() * 5) * 200) + 'px');
			}
		};
	}();
	$.extend($.easing,{
		bounceOut: function (x, t, b, c, d) {
			if ((t/=d) < (1/2.75)) {
				return c*(7.5625*t*t) + b;
			} else if (t < (2/2.75)) {
				return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
			} else if (t < (2.5/2.75)) {
				return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
			} else {
				return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
			}
		},
		easeOut:function (x, t, b, c, d) {
			return -c *(t/=d)*(t-2) + b;
		},
		elasticOut: function (x, t, b, c, d) {
			var s=1.70158;var p=0;var a=c;
			if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
			if (a < Math.abs(c)) { a=c; var s=p/4; }
			else var s = p/(2*Math.PI) * Math.asin (c/a);
			return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
		}
	});
	$(document).ready(slotMachine.init);
})(jQuery);
