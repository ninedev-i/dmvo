@extends('master')

@section('scripts')
   <script src="{{URL::to('/')}}/public/js/masonry.js"></script>
   <script>$(document).ready(function() {$("#alldirections").masonry({itemSelector: ".direction", singleMode: false, isResizable: true, isAnimated: true, animationOptions: {queue: false, duration: 500}});});</script>
@endsection

@section('title', $page->title)

@section('content')
   {!! $adminlink !!}
   <div id="alldirections" class="aboutPage">

      <div class="direction">
         <a href="about/info">
            <div class="dirimage" style="background-image: url(public/img/about/1.jpg);"></div>
            <h3>О доме молодежи</h3>
            <p>Дом молодежи является центром по организации досуга молодого поколения на Васильевском острове.  Молодежные мероприятия гражданско-патриотические и развлекательные, расширяющие кругозор и приобщающие к традиционной культуре разных народов, праздники для молодых семей, творческие фестивали, конкурсы, выставки – спектр деятельности широк и разнообразен. Для старшеклассников ДМ ВО предлагает профтестирование, посещение ярмарки профессий  и игры, направленные на профессиональное самоопределение.</p>
         </a>
      </div>

      <div class="direction">
         <a href="about/halls">
            <div class="dirimage" style="background-image: url(public/img/about/5.jpg); background-position: 50% 40%;"></div>
            <h3>Материальная база</h3>
            <p>Дом молодежи Василеостровского района создан в рамках городской программы открытия районных домов молодежи. Общая площадь Дома молодежи Василеостровского района составляет 4 788,8 кв.м. В здании 63 помещения, в том числе концертный зал на 583 места и Голубой акустический зал  на 120 мест.</p>
         </a>
      </div>

      <div class="direction">
         <a href="about/studio">
            <div class="dirimage" style="background-image: url(public/img/about/6.jpg); background-position: 50% 60%;"></div>
            <h3>Формы молодежного досуга</h3>
            <p>Около полутора тысяч человек ежемесячно посещающих кружки, секции, комнату свободного общения, Молодёжную приёмную, любительские объединения. В 2017 году на базе учреждения работает 35 бюджетных, 11 платных кружков и секций музыкального, театрального, физкультурно-оздоровительного, изобразительно-прикладного, вокального, танцевального, патриотического направлений, а также фото и киностудия.</p>
         </a>
      </div>

      <div class="direction">
         <a href="about/team">
            <div class="dirimage" style="background-image: url(public/img/about/3.jpg); background-position: 50% 40%;"></div>
            <h3>Коллектив</h3>
            <p>Дом молодёжи Василеостровского района – это развивающийся творческий коллектив, насчитывающий более 70 человек. 6 сотрудников имеют высшую квалификацию, 5 – первую, 13 – вторую квалификационную категорию. В Доме молодёжи работают шесть основных отделов. Отдел творческой самореализации и поддержки талантливой молодежи самый многочисленный. Он объединил руководителей кружков, секций, любительских объединений. Здесь всегда кипит жизнь: участие в конкурсах международных и городских, выступления, подготовка к концертам, спектаклям, участие в городских масштабных мероприятиях на Дворцовой площади, Стрелке Васильевского острова…</p>
         </a>
      </div>

      <div class="direction">
         <a href="about/volunteer">
            <div class="dirimage" style="background-image: url(public/img/about/4.jpg); background-position: 50% 36%;"></div>
            <h3>Молодежные инициативы</h3>
            <p>«Будущее начинается с тебя!» - это девиз тех, кто строит завтра. Это девиз наших активистов и волонтёров. Основы волонтёрского движения в нашем доме молодёжи были заложены в 2011 году, в 2014 году была открыта Молодёжная приёмная. Целый год она искала своего истинного лидера и смогла заработать в полную силу только в 2015.</p>
         </a>
      </div>

      <div class="direction">
         <a href="about/history">
            <div class="dirimage" style="background-image: url(public/img/about/8.jpg); background-position: 50% 60%;"></div>
            <h3>История здания</h3>
            <p>Участок дома №65 на Большом проспекте Васильевского острова в XVIII веке занимали склады винных морских магазинов (рис. 1 Карта 1776 г). В 1790х годах его передали под плац Кексгольмского пехотного полка. В 1810х годах здесь разместились казармы полкового лазарета, фурштатский двор, манеж и огороды лейб-гвардии Финляндского полка. В 1807 в Стрельне из финнов дворцовых деревень был создан Императорский батальон милиции, который через четыре года преобразовали в гвардейский полк, отличившийся в Отечественной войне, в битве под Лейпцигом, и в Русско-турецкой войне (1877–1878). </p>
         </a>
      </div>

      <div class="direction">
         <a href="about/massmedia">
            <div class="dirimage" style="background-image: url(public/img/about/9.jpg); background-position: 50% 60%;"></div>
            <h3>СМИ о нас</h3>
         </a>
      </div>

      <div class="direction">
         <a href="about/board">
            <div class="dirimage" style="background-image: url(public/img/about/10.jpg); background-position: 50% 60%;"></div>
            <h3>Информационный стенд</h3>
         </a>
      </div>

      <div class="direction">
         <a href="about/enviroment">
            <div class="dirimage" style="background-image: url(public/img/about/11.png); background-position: 50% 60%;"></div>
            <h3>Доступная среда</h3>
         </a>
      </div>

      <div class="direction">
         <a href="about/corruption">
            <div class="dirimage" style="background-image: url(public/img/about/12.jpg); background-position: 50% 40%;"></div>
            <h3>Противодействие коррупции</h3>
         </a>
      </div>

   </div>
{!! $page->content !!}
@endsection
