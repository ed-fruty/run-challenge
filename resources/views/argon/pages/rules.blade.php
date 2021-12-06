@extends('argon.layouts.argon')

@section('title')
    Run Winter
@endsection

@section('content')
    <div class="section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <h2 class="display-3 ">Правила</h2>
                <div class="card shadow">
                    <div class="card-body text-left">
                        1.<br>
                        Ежедневная пробежка должна составлять не менее 3км одним целым записанным треком. Темп пробежки каждый выбирает сам, но он должен быть не менее 8:30мин\км, или не менее 7км\час, когда темп ниже уже можно считать пешей прогулкой, такая пробежка не засчитывается.
                    </div>
                </div>
                <hr>
                <div class="card shadow">
                    <div class="card-body text-left">
                        2.<br>
                        Засчитываются пробежки только на улице, имеющие gps трек, т.е. Пробежки в крытом манеже или на беговом тренажере не засчитываются, пробежки имеющие километраж но не имеющие ни темпа ни трека не засчитываются.
                    </div>
                </div>
                <hr>
                <div class="card shadow">
                    <div class="card-body text-left">
                        3.<br>
                        В день засчитывается любое количество пробежек, каждая из которых не менее 3км. (для примера, если Вы сделали 3и пробежки в день по 3км то вам засчитывается 9км в день, а если вы сделали 3и пробежки, две по 3км и одну 2км, то зачтутся только 6км. В не зависимости от того подряд пробежки или в разное время суток.)
                    </div>
                </div>
                <hr>
                <div class="card shadow">
                    <div class="card-body text-left">
                        4.<br>
                        В правилах предусмотрено (на сезон 21/22) 5 дней пропуска за весь челлендж по уважительной причине (длительный переезд\болезнь и т.п.). Эти пропущенные 5 дней отмечаются как долг, который вы потом в любой день челленджа (хоть через месяц) должны отбегать дополнительной пробежкой в разное время дня, не подряд!
                    </div>
                </div>
                <hr>
                <div class="card shadow">
                    <div class="card-body text-left">
                        5.<br>
                        В челлендже допускаются дополнительные пропуски для всех при форс-мажорных погодных условиях и температурах не рекомендуемых к бегу на улице, таковыми являются: -температура на улице ниже -20, ветер с порывами более 20м/сек, - иные форс-мажорные обстоятельства такие как штормовое предупреждение/снегопад превышающий нормы осадков за 3е и более суток. Пропуски по погодным условиям можно.
                    </div>
                </div>
                <hr>
                <div class="card shadow">
                    <div class="card-body text-left">
                        6.<br>
                        Треки записанные с некорректным темпом не принимаются. Не корректным считается явный разброс темпа по дистанции не свойственный бегуну.
                    </div>
                </div>
                <hr>
                <div class="card shadow">
                    <div class="card-body text-left">
                        7.<br>
                        В сезоне 21/22 допускается 1 законный выходной в неделю. Участник сам определяет этот день по своему желанию и самочувствию. Этим днём можно не пользоваться.
                    </div>
                </div>
                <hr>
                <div class="card shadow">
                    <div class="card-body text-left">
                        8.<br>
                        Запрещается обсуждать участниками пробежки других участников. Каждый думает только о своих пробежках и обсуждает только свои пробежки. Если в протоколе какая то ошибка по вашим пробежкам отправьте информацию организатору личным сообщением.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
