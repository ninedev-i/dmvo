class ContentEditor {
   constructor(number, withTransform) {
      this.contentArea = $('.mycontent' + number),
      this.htmlArea = $('.hiddenarea' + number);
      this.showText = $('#showtext' + number);
      this.showHtml = $('#showhtml' + number);
      this.withTransform = withTransform || false;

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

      if (this.withTransform) {
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
      }

      this.htmlArea.val(ourcontent);
      if (isPaste) {
         this.contentArea.html(ourcontent);
      }
   }

}
