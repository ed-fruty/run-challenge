@extends('argon.layouts.argon')

@section('title')
    Run Winter
@endsection

@section('content')
    <div class="wrapper">
        <div class="section" style="background-image: url('/argon-design-system/assets/img/ill/1.svg');">
            <div class="container py-md">
                <div class="row justify-content-between align-items-center">
                    <div class="col-lg-6 mb-lg-auto">
                        <div class="rounded overflow-hidden transform-perspective-left">
                            <div id="carousel_example" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel_example" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel_example" data-slide-to="1"></li>
                                    <li data-target="#carousel_example" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="img-fluid" src="http://runwinter.com/site/site_image/1.jpg" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid" src="http://runwinter.com/site/site_image/2.jpg" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="img-fluid" src="http://runwinter.com/site/site_image/3.jpg" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carousel_example" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel_example" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mb-5 mb-lg-0">
                        <h1 class="font-weight-light">Челлендж 90 дней бега зимой.</h1>
                        <p class="lead mt-4">Так закаляется характер. <br>
                            Просто поверь в себя. <br>
                            Ты сможешь. Побежали!
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-outline-default mt-4">
                            <span class="btn-inner--icon"><i class="ni ni-user-run"></i></span>
                            <span class="btn-inner--text">Участвовать</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <h3 class="display-3">Пришла зима, а с ней всегда приходит зимний челлендж
                        Run Winter</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="info">
                        <p class="description opacity-8">В этом году он уже 6-ый по счету. В нем собираются участники из разных городов и стран. От относительно теплого юга до северных широт со снегом и метелями.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info">
                        <p class="description opacity-8">Разные часовые пояса, между учасниками тысячи километров, у одних +5 градусов, а у других -25 градусов.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info">
                        <p class="description opacity-8">Всех их объединяет зимний челлендж Run Winter.</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 text-center">
                        <h2 class="display-3">Последние пробежки</h2>
                        <table class="table table-hover  table-neutral table-bordered datatable">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th></th>
                                <th>Участник</th>
                                <th>Темп</th>
                                <th>Дистанция</th>
                                <th>Страна</th>
                                <th>Город</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latest as $activity)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if($activity->user->photo_url)
                                            <img src="{{ $activity->user->photo_url }}" alt="" class="avatar avatar-xs rounded-circle">
                                        @endif
                                    </td>
                                    <td><a href="{{ route('users.show', $activity->user->id) }}" class="btn btn-link text-primary">{{ $activity->user->name }} {{ $activity->user->lastname }}</a> </td>
                                    <td>{{ $activity->getTemp() }}</td>
                                    <td>{{ $activity->getDistanceInKm() }} км</td>
                                    <td>{{ $activity->country }}</td>
                                    <td>{{ $activity->city }}</td>
                                    <td>{{ $activity->start_date->format('d.m.Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="section features-6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="info info-horizontal info-hover-primary">
                            <div class="row">
                                <div class="col-md-8 mx-auto text-center">
                                    <h3 class="display-3">Статистика текущего сезона</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <div class="info">
                                        <div class="icon icon-lg icon-shape icon-shape-primary shadow rounded-circle">
                                            <i class="fa fa-user-circle-o"></i>
                                        </div>
                                        <h6 class="info-title text-uppercase text-primary">{{ \App\Models\User::count() }} участников</h6>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="info">
                                        <div class="icon icon-lg icon-shape icon-shape-success shadow rounded-circle">
                                            <i class="fa fa-recycle"></i>
                                        </div>
                                        <h6 class="info-title text-uppercase text-success">{{ \App\Models\Activity::count() }} пробежек</h6>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="info">
                                        <div class="icon icon-lg icon-shape icon-shape-warning shadow rounded-circle">
                                            <i class="fa fa-dashcube"></i>
                                        </div>
                                        <h6 class="info-title text-uppercase text-warning">{{ round(\App\Models\Activity::query()->sum('distance') / 1000, 2) }} км</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section features-6">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="info info-horizontal info-hover-primary">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="description pl-4">
                                        <h5 class="title">Как правильно бегать зимой?</h5>
                                        <p>Бег зимой опасен растяжениями и падениями, с другой стороны, нестабильное покрытие поможет укрепить мышцы ног и стопы. Скользкая поверхность не позволит ставить ногу как попало. Организм сам подстроит технику бега: шаги станут короче, увеличится каденс, нога будет ставиться под центр тяжести — это поможет улучшить технику к соревновательному периоду. Бегите мягко, без резких отталкиваний и «втыканий».</p>

                                        <p>    Чтобы не получить травму, обязательно сделайте разминку в помещении перед выходом на тренировку: разогрейте мышцы, связки и суставы. Но не переусердствуйте, вы должны разогреться, не вспотев, чтобы не замерзнуть на улице.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="http://runwinter.com/site/site_image/photo1.jpg" class="img-fluid rounded shadow-lg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="info info-horizontal info-hover-primary mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="http://runwinter.com/site/site_image/photo2.jpg" class="img-fluid rounded shadow-lg" alt="">
                                </div>
                                <div class="col-md-6">
                                    <div class="description pl-4">
                                        <h5 class="title">Одежда для бега зимой на улице</h5>
                                        <p>Частая ошибка начинающих бегунов зимой — слишком теплая одежда. Для бега нужно одеваться так, будто на улице на 10° теплее. То есть для бега в -15° одевайтесь так, будто на улице -5°. В правильно подобранной экипировке в начале пробежки будет немного прохладно, но станет комфортно уже через 1-2 км.</p>

                                        <p>    Самое важное в одежде для бега зимой — отвод лишней влаги. Поэтому выбирайте одежду из синтетики и соблюдайте принцип многослойности. Не используйте хлопок, шерсть и другие натуральные материалы.
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info info-horizontal info-hover-primary mt-5">
                            <div class="description pl-4">
                                <h5 class="title">Как бегать зимой и не заболеть?</h5>
                                <p>  - Привыкайте к холоду постепенно. При регулярных тренировках с понижением температуры организм сам адаптируется. Если пропустили всю осень, а зимой решили возобновить тренировки, начинайте с небольших медленных кроссов. Сдерживайте себя, даже если кажется, что бежится легко</p>
                                <p> - Держите в тепле шею, голову и лодыжки</p>
                                <p> - После тренировки сразу идите в тепло или переоденьтесь в сухое</p>
                                <p> - Разминку, растяжку и упражнения делайте в помещении</p>
                                <p> - Бегайте в синтетической спортивной экипировке</p>
                                <p> - Надевайте длинные носки и гамаши</p>
                                <p> - Соблюдайте стандартные правила для здорового иммунитета: высыпайтесь, качественно питайтесь, избегайте перегрузок</p>
                            </div>
                        </div>
                        <div class="info info-horizontal info-hover-primary mt-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="http://runwinter.com/site/site_image/photo3.jpg" class="img-fluid rounded shadow-lg" alt="">
                                </div>
                                <div class="col-md-6">
                                    <div class="description pl-4">
                                        <h5 class="title">Как дышать во время бега зимой?</h5>
                                        <p>Дышите как вам удобно. Оптимально дышать через нос и рот одновременно, но это не у всех получается. Забудьте про советы дышать только через нос — бежать будет тяжелее, а сильный поток холодного воздуха может обжечь слизистую носа.</p>

                                        <p> С непривычки есть риск надышаться и подхватить инфекцию дыхательных путей, поэтому привыкайте к холодному воздуху постепенно. С похолоданием сократите интервальные и скоростные тренировки и бегайте спокойные кроссы, пока организм адаптируется к холоду.
                                        </p>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info info-horizontal info-hover-primary mt-5">
                            <div class="description pl-4">
                                <h5 class="title">Снег = сила</h5>
                                <p>Бег по снегу значительно отличается от бега по асфальту — скользкая поверхность дополнительно прокачивает мышцы: в усиленном режиме будут работать икроножные, а также мышцы бедра и ягодиц.</p>

                                <p>    Каждый раз во время постановки стопы идёт сокращение огромного числа мышц по всему телу, в первую очередь глубоких, отвечающих за поддержку нашего скелета и его стабильное вертикальное положение.</p>

                                <p>    Бег по глубокому снегу подключает в работу еще и мышцы спины, брюшного пресса, плеч и рук. Такая тренировка сочетает в себе бег и силовой тренинг одновременно.</p>

                                <p>     Первые пару недель может наблюдаться эффект «после тренировки все болит так, будто меня переехал каток», но после привыкания — сплошная польза и улучшение координации. А после того, как снег сойдет, вы удивитесь, с какой легкостью и скоростью «полетите» по асфальту.
                                </p>
                                <h5 class="title">Побежали !</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
