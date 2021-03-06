@extends('layouts.app',['title' => __('Search'), 'sub' => __('messages.search.index.desc')])

@section('content')
    <div id="twinbox">
        <div id="contentwide">
            <div class="msgbox">
                <div class="msgboxtop">{{ __('Search') }}</div>
                <div class="msgboxbody">
                    <h2>{{ __('search-index.name.header') }}</h2>
                    <form action="{{ url('/search') }}" method="get" name="name" style="text-align: center">
                        <input type="search" name="name" class="textarea" required style="width: 300px" title="{{ __('Name') }}" placeholder="{{ __('Name') }}">
                        <input type="submit" value="{{ __('Search') }}" class="button">
                    </form>
                    <p class="notification">
                        {{ __('search-index.name.notice.0') }}<br>{{ __('search-index.name.notice.1') }}
                    </p>
                    <h2>{{ __('search-index.birthplace.header') }}</h2>
                    <form action="{{ url('/search') }}" method="get" name="birthplace" style="text-align: center">
                        <label>
                            <select name="birthplace">
                                <option value="" disabled selected>{{ __('search-index.dropdown') }}</option>
                                <optgroup label="{{ __('place.area.hokkaido') }}">
                                    <option value="北海道">{{ __('place.pref.北海道') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('place.area.tohoku') }}">
                                    <option value="null" disabled style="background: rgba(0,0,0,0.2)">
                                        @if(App::isLocale('ja')) 該当なし @else None @endif
                                    </option>
                                    <!--<option value="東北">東北地方全域</option>
                                    <option value="青森">青森</option>
                                    <option value="岩手">岩手</option>
                                    <option value="宮城">宮城</option>
                                    <option value="秋田">秋田</option>
                                    <option value="山形">山形</option>
                                    <option value="福島">福島</option>-->
                                </optgroup>
                                <optgroup label="{{ __('place.area.kanto') }}">
                                    <option value="関東">{{ __('place.area.kanto') }}</option>
                                    <option value="東京都">{{ __('place.pref.東京都') }}</option>
                                    <option value="神奈川県">{{ __('place.pref.神奈川県') }}</option>
                                    <option value="埼玉県">{{ __('place.pref.埼玉県') }}</option>
                                    <option value="千葉県">{{ __('place.pref.千葉県') }}</option>
                                    <option value="茨城県">{{ __('place.pref.茨城県') }}</option>
                                    <!--<option value="栃木県">{{ __('place.pref.栃木県') }}</option>
                                    <option value="群馬県">{{ __('place.pref.群馬県') }}</option>-->
                                </optgroup>
                                <optgroup label="{{ __('place.area.chubu') }}">
                                    <option value="中部">{{ __('place.area.chubu') }}</option>
                                    <!--<option value="新潟県">新潟県</option>
                                    <option value="富山県">富山県</option>-->
                                    <option value="石川県">{{ __('place.pref.石川県') }}</option>
                                    <!--<option value="福井県">福井県</option>
                                    <option value="山梨県">山梨県</option>-->
                                    <option value="長野県">{{ __('place.pref.長野県') }}</option>
                                    <!--<option value="岐阜県">岐阜県</option>-->
                                    <option value="静岡県">{{ __('place.pref.静岡県') }}</option>
                                    <option value="愛知県">{{ __('place.pref.愛知県') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('place.area.kinki') }}">
                                    <option value="近畿">{{ __('place.area.kinki') }}</option>
                                    <option value="大阪府">{{ __('place.pref.大阪府') }}</option>
                                    <!--<option value="兵庫県">兵庫県</option>
                                    <option value="京都府">京都府</option>
                                    <option value="滋賀県">滋賀県</option>
                                    <option value="奈良県">奈良県</option>
                                    <option value="和歌山県">和歌山県</option>
                                    <option value="三重県">三重県</option>-->
                                </optgroup>
                                <optgroup label="{{ __('place.area.kinki') }}?">
                                    <option value="京都府？">{{ __('place.pref.京都府？') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('place.area.chugoku') }}">
                                    <option value="中国">{{ __('place.area.chugoku') }}</option>
                                    <!--<option value="鳥取県">鳥取県</option>
                                    <option value="島根県">島根県</option>
                                    <option value="岡山県">岡山県</option>-->
                                    <option value="広島県">{{ __('place.pref.広島県') }}</option>
                                    <option value="山口県">{{ __('place.pref.山口県') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('place.area.shikoku') }}">
                                    <option value="四国">{{ __('place.area.shikoku') }}</option>
                                    <!--<option value="徳島県">徳島県</option>-->
                                    <option value="香川県">{{ __('place.pref.香川県') }}</option>
                                    <option value="愛媛県">{{ __('place.pref.愛媛県') }}</option>
                                    <!--<option value="高知県">高知県</option>-->
                                </optgroup>
                                <optgroup label="{{ __('place.area.kyushuokinawa') }}">
                                    <option value="九州沖縄">{{ __('place.area.kyushuokinawa') }}</option>
                                    <option value="福岡県">{{ __('place.pref.福岡県') }}</option>
                                    <!--<option value="佐賀県">佐賀</option>
                                    <option value="長崎県">長崎</option>
                                    <option value="熊本県">熊本</option>
                                    <option value="大分県">大分</option>
                                    <option value="宮崎県">宮崎</option>
                                    <option value="鹿児島県">鹿児島</option>-->
                                    <option value="沖縄県">{{ __('place.pref.沖縄県') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('place.area.overseas') }}">
                                    <option value="海外">{{ __('place.area.overseas') }}</option>
                                    <option value="イギリス">{{ __('place.pref.イギリス') }}</option>
                                    <option value="ブラジル">{{ __('place.pref.ブラジル') }}</option>
                                    <option value="オーストリア">{{ __('place.pref.オーストリア') }}</option>
                                </optgroup>
                                <optgroup label="{{ __('place.area.unknown') }}">
                                    <option value="不明">{{ __('place.area.unknown') }}</option>
                                </optgroup>
                            </select>
                        </label>
                        <input type="submit" value="{{ __('Search') }}" class="button">
                    </form>
                    <p class="notification">
                        {{ __('search-index.birthplace.notice') }}
                    </p>
                    <h2>{{ __('search-index.birthdate.header') }}</h2>
                    <form action="{{ url('/search') }}" method="get" name="birthday" style="text-align: center">
                        <select name="month" title="{{ __('Month') }}">
                            <option value="u" selected>-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select><span style="margin:0 4px">{{ App::isLocale('ja') ? '月' : '/' }}</span>
                        <select name="day" title="{{ __('Day') }}">
                            <option value="u" selected>-</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select><span style="margin:0 4px">{{ App::isLocale('ja') ? '日' : '' }}</span>
                        <input type="submit" value="{{ __('Search') }}" class="button">
                    </form>
                    <p class="notification">
                        {{ __('search-index.birthdate.notice.0') }}<br>
                        {{ __('search-index.birthdate.notice.1') }}<br>
                        {{ __('search-index.birthdate.notice.2') }}
                    </p>
                    <h2>{{ __('search-index.age.header') }}</h2>
                    <form action="{{ url('/search') }}" method="get" name="age" style="text-align:center;">
                        <input type="number" name="age" title="{{ __('search-index.age.input') }}" placeholder="{{ __('search-index.age.input') }}" class="textarea" max="40" min="10" required style="width: 110px;padding-left:15px">
                        <span style="margin: 4px 0;font-weight: bold">{{ __('years old') }}</span>
                        <select name="range" class="select" title="{{ __('search-index.age.range') }}">
                            <option value="higher">{{ __('search-index.age.range.older') }}</option>
                            <option value="equal" selected>{{ __('search-index.age.range.equal') }}</option>
                            <option value="lower">{{ __('search-index.age.range.younger') }}</option>
                        </select>
                        <input type="submit" value="{{ __('Search') }}" class="button">
                    </form>
                    <p class="notification">
                        {{ __('search-index.age.notice') }}
                    </p>
                </div>
                <div class="msgboxfoot">
                    <a href="javascript:searchByAllCondition()" class="button jw">{{ __('search-index.searchbyallcond') }}</a>
                    <script>
                        function searchByAllCondition(){
                            var url = location.pathname+'?';
                            if(document.forms.name.name.value) url += 'name=' + document.forms.name.name.value + '&';
                            if(document.forms.birthplace.birthplace.value) url += 'birthplace=' + document.forms.birthplace.birthplace.value + '&';
                            if(document.forms.birthday.month.value !== 'u' || document.forms.birthday.day.value !== 'u')
                                url += 'month=' + document.forms.birthday.month.value + '&day=' + document.forms.birthday.day.value + '&';
                            if(document.forms.age.age.value) url += 'age=' + document.forms.age.age.value + '&range=' + document.forms.age.range.value + '&';
                            location.href = url.substr(0,url.length-1);
                        }
                    </script>
                </div>
            </div>
        </div>
        <div id="contentnarrow">
            <div class="msgbox">
                <div class="msgboxtop">Inform@tion</div>
                <div class="msgboxbody">
                    <h3>{{ __('How to use') }}</h3>
                    <p>{{ __('search-index.howtouse') }}</p>
                </div>
                <div class="msgboxfoot">
                    <a class="button jw" href="javascript:location.reload()">{{ __('Reset') }}</a>
                </div>
            </div>
        </div>
    </div>


@endsection
