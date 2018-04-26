<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Письмо с сайта</title>
   </head>

   <body style='background-color: #f3f3f3; font-family: Helvetica,sans-serif; ; font-size: 1em;'>
      <div style='display: block; margin-left: 2%; margin-right: 2%; margin-bottom: 10px; border-top: 20px solid #f3f3f3; width: 96%; height: 66px; color: white; background-color: #006699; color: white; line-height: 65px; font-weight: bold; font-size: 30px; text-align: center;'>Дом молодежи Василеостровского района</div>
      <div style='display: block; margin-left: 2%; margin-right: 2%; margin-bottom: 10px; border-bottom: 20px solid #f3f3f3; padding: 2%; width: 92%; background-color: white; font-family: Helvetica,sans-serif; font-size: 1em;'>
         <b>Имя:</b> {{ $name }}<br />
         <b>E-mail:</b> {{ $email }}<br />
         <b>Телефон</b> {{ $phone }}<br />
         <b>Ваш возраст:</b> {{ $age }}<br />
         <b>Удобная дата и время консультации:</b> {{ $date }}<br />
         <b>Запрос:</b> {{ $choice }}<br />
         <b>Специалист:</b> {{ $specialist }}<br />
         <b>Комментарий:</b> {{ $textmessage }}<br />
      </div>
   </body>
</html>
