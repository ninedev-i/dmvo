// $(document).ready(function() {
// 	if ($(".hiddenarea").val() != "") {$(".mycontent").html($(".hiddenarea").val());}
// 	// �� div � �����
// 	$('.mycontent').keyup(function(){
// 		var ourcontent = $(".mycontent").html();
// 		ourcontent = ourcontent.replace(/\s/gi, ' ');
// 		ourcontent = ourcontent.replace(/ style=".+?"| class=".+?"| id=".+?"| color=".+?"| face=".+?"| lang=".+?"| align=".+?"| name=".+?"| xml:lang="en-US"|<!\-\-\[endif\]\-\->|<!\-\-\[if !supportLists\]\-\->/gi, '');
// 		ourcontent = ourcontent.replace(/<span>|<\/span>|<font>|<\/font>|<o:p>|<\/o:p>|<wbr>|<div>|<\/div>/gi, '');
// 		ourcontent = ourcontent.replace(/&nbsp;/gi, ' ');
// 		ourcontent = ourcontent.replace(/  /g, ' ');
// 		ourcontent = ourcontent.replace(/\.00/g, ':00');
// 		ourcontent = ourcontent.replace(/\.30/g, ':30');
// 		ourcontent = ourcontent.replace(/<p>\s+<\/p>|<p><\/p>/gi, '');
// 		/*ourcontent = ourcontent.replace(/"(.*)"/g, '�$1�');*/
// 		ourcontent = ourcontent.replace(/<\/p><p>|<\/p>\s+<p>/gi, '</p>\n<p>');
// 		$('.hiddenarea').val(ourcontent);
// 	});
// 	// ������������ ����� �����������
// 	$('#showtext').click(function(){
// 		$('.mycontent').css('display', 'block');
// 		$('.hiddenarea').css('display', 'none');
// 		var ourarea = $(".hiddenarea").val();
// 		$('.mycontent').html(ourarea);
// 	});
// 	$('#showhtml').click(function(){
// 		$('.hiddenarea').css('display', 'block');
// 		$('.mycontent').css('display', 'none');
// 	});
//
//
// // ������ �����
//
//
// 	if ($(".hiddenarea1").val() != "") {$(".mycontent1").html($(".hiddenarea1").val());}
// 	// �� div � �����
// 	$('.mycontent1').keyup(function(){
// 		var ourcontent1 = $(".mycontent1").html();
// 		ourcontent1 = ourcontent1.replace(/\s/gi, ' ');
// 		ourcontent1 = ourcontent1.replace(/ style=".+?"| class=".+?"| id=".+?"| color=".+?"| face=".+?"| lang=".+?"| align=".+?"| name=".+?"| xml:lang="en-US"|<!\-\-\[endif\]\-\->|<!\-\-\[if !supportLists\]\-\->/gi, '');
// 		ourcontent1 = ourcontent1.replace(/<span>|<\/span>|<font>|<\/font>|<o:p>|<\/o:p>|<wbr>|<div>|<\/div>/gi, '');
// 		ourcontent1 = ourcontent1.replace(/&nbsp;/gi, ' ');
// 		ourcontent1 = ourcontent1.replace(/  /g, ' ');
// 		ourcontent1 = ourcontent1.replace(/\.00/g, ':00');
// 		ourcontent1 = ourcontent1.replace(/\.30/g, ':30');
// 		ourcontent1 = ourcontent1.replace(/<p>\s+<\/p>|<p><\/p>/gi, '');
// 		/*ourcontent1 = ourcontent1.replace(/"(.*)"/g, '�$1�');*/
// 		ourcontent1 = ourcontent1.replace(/<\/p><p>|<\/p>\s+<p>/gi, '</p>\n<p>');
// 		$('.hiddenarea1').val(ourcontent1);
// 	});
// 	// ������������ ����� �����������
// 	$('#showtext1').click(function(){
// 		$('.mycontent1').css('display', 'block');
// 		$('.hiddenarea1').css('display', 'none');
// 		var ourarea1 = $(".hiddenarea1").val();
// 		$('.mycontent1').html(ourarea1);
// 	});
// 	$('#showhtml1').click(function(){
// 		$('.hiddenarea1').css('display', 'block');
// 		$('.mycontent1').css('display', 'none');
// 	});
// });

class ContentEditor {
   constructor(number) {
      this.contentArea = $('.mycontent' + number),
      this.htmlArea = $('.hiddenarea' + number);
      this.showText = $('#showtext' + number);
      this.showHtml = $('#showhtml' + number);

      this.eventListener.call(this);
   }

   eventListener() {
      $(document).ready(function() {
         this.contentArea.html(this.htmlArea.val());
      }.bind(this));

      this.contentArea.bind('paste', function(e) {
         setTimeout(function () {
            let content = this.contentArea.html();
            this.transformtext(content, true);
      	}.bind(this), 100);
      }.bind(this));

      this.contentArea.bind('keyup', function(e) {
         let content = this.contentArea.html();
         this.transformtext(content, false);
      }.bind(this));

      this.htmlArea.bind('input textarea', function(e) {
         this.contentArea.html(this.htmlArea.val());
      }.bind(this));


      this.showText.click(function() {
      	this.contentArea.css('display', 'block');
      	this.htmlArea.css('display', 'none');
      }.bind(this));
      this.showHtml.click(function(){
      	this.htmlArea.css('display', 'block');
      	this.contentArea.css('display', 'none');
      }.bind(this));

   }

   transformtext(text, isPaste) {
      let ourcontent = text;
      ourcontent = ourcontent.replace(/\s/gi, ' ');
      ourcontent = ourcontent.replace(/ style=".+?"| class=".+?"| id=".+?"| itemprop=".+?"| data-vdir-href=".+?"| data-mce-href=".+?"| data-orig-href=".+?"| color=".+?"| face=".+?"| lang=".+?"| align=".+?"| name=".+?"| data-mce-style=".+?"| xml:lang="en-US"|<!\-\-\[endif\]\-\->|<!\-\-\[if !supportLists\]\-\->/gi, '');
      ourcontent = ourcontent.replace(/<span>|<\/span>|<font>|<\/font>|<o:p>|<\/o:p>|<wbr>|<div>|<\/div>|<pre>|<\/pre>|<code>|<\/code>/gi, '');
      ourcontent = ourcontent.replace(/&nbsp;/gi, ' ');
      ourcontent = ourcontent.replace(/  /g, ' ');
      ourcontent = ourcontent.replace(/\.00/g, ':00');
      ourcontent = ourcontent.replace(/\.30/g, ':30');
      ourcontent = ourcontent.replace(/<p>\s+<\/p>|<p><\/p>|<h1><\/h1>|<b><\/b>|<b>\s+<\/b>/gi, '');
      ourcontent = ourcontent.replace(/<\/p><p>|<\/p>\s+<p>/gi, '</p>\n<p>');
      ourcontent = ourcontent.replace(/<br>|<br\/>|<br \/>/gi, '<br />\n');

      this.htmlArea.val(ourcontent);
      if (isPaste) {
         this.contentArea.html(ourcontent);
      }
   }

}

new ContentEditor(1);
new ContentEditor(2);
