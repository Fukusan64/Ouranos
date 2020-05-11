@extends('layouts.app',['title' => $title, 'sub' => __('messages.idol.show.desc'), 'css' => 'idol'])

@section('content')
    @if(date('2017-m-d') === $idol->birthdate) {{-- 2017-m-d --}}
        <div id="happybirthday" style="background: rgba({{ convertColorcode($idol->color,true) }},0.3);display: flex">
            <img src="{{ asset('image/icon/'.$idol->name_r.'/0.png') }}" alt="{{ $idol->name }}" style="width: 55px;display: block;padding-right: 12px">
            <div>
                <span style="font-size:25px">Happy Birthday {{ ucfirst(substr($idol->name_r,0,($idol->name_r_separate ?: strlen($idol->name_r)))) }}!</span><br>
                {{ date('l F jS, Y') }}
            </div>
        </div>
    @endif
    <div id="idoldetail">
        <img id="tachie" src="{{ asset('image/tachie/'.$idol->name_r.'.png') }}" alt="{{ $idol->name }}">
        <div id="info">
            <div id="dataheader">
                <div id="idolname" class="{{ $idol->type }}">
                    <span style="font-size: 32px">{{ !empty($idol->subname) ? $idol->subname : separateString($idol->name,$idol->name_separate) }}</span><br>
                    <span style="color: gray">{{ mb_strtoupper(separateString($idol->name_r,$idol->name_r_separate)) }}</span>
                </div>
                <table id="idolinfo">
                    <tr>
                        <th title="{{ __('messages.idol.show.dbid') }}">{{ __('Database ID') }}</th><td>{{ $idol->id }}</td>
                    </tr>
                    <tr>
                        <th title="{{ __('messages.idol.show.type') }}">{{ __('Idol').(isCJ() ? '' : ' ').__('Type') }}</th>
                        <td>
                            <span style="{{ empty($idol->greemas_type) ? 'font-style:italic' : 'color:'.getTypeColor($idol->greemas_type) }}" title="GREE Ver">
                                {{ $idol->greemas_type ?? 'N/A' }}</span> /
                            <span style="color: {{ getTypeColor($idol->type) }}" title="MLTD">{{ $idol->type }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>{{ __('Personal Color') }}</th>
                        <td style="color:{{ '#'.($idol->color ?: '000') }}" onclick="setClipboard(this.innerText)"
                            title="{{ __('messages.common.setclipboard') }}"
                            class="colorcode">{{ !empty($idol->color) ? '#'.str_replace('#','',$idol->color) : 'N/A' }}</td>
                    </tr>
                </table>
            </div>
            <hr class="gradient">
            <table id="datatable">
                <tr>
                    <?php /** @var App\Idol $idol */
                    $namestr = separateString($idol->name,$idol->name_separate);
                    if(!empty($idol->subname)) $namestr .= ' ('.$idol->subname.')';
                    $dateflag = App::isLocale('ja') ? 'ja' : 'slash';
                    $urlname = urlencode($idol->name) ?>
                    <th>{{ __('Name') }}</th><td colspan="2" class="ja">{{ $namestr }}</td>
                    <th>{{ __('CV') }}</th><td colspan="2" class="ja">{{ $idol->cv }}</td>
                </tr>
                <tr>
                    <th>{{ __('Hiragana') }}</th><td colspan="2" class="ja">{{ separateString($idol->name_y,$idol->name_y_separate) }}</td>
                    <th>{{ __('Chinese')  }}</th><td colspan="2" class="zh_TW">{{ $idol->name_zh ? separateString($idol->name_zh,$idol->name_zh_separate) : __('N/A') }}</td>
                </tr>
                <tr>
                    <th>Alphabet</th><td colspan="2">{{ ucwords(separateString($idol->name_r,$idol->name_r_separate)) }}</td>
                    <th>{{ __('Hangul') }}</th><td colspan="2">{{ $idol->name_ko ? separateString($idol->name_ko,$idol->name_ko_separate) : __('N/A') }}</td>
                </tr>
                <tr>
                    <th>{{ __('Birthdate') }}</th><td>{{ $idol->birthdate ? convertDateString($idol->birthdate,$dateflag) : __('N/A') }}</td>
                    <th>{{ __('Height') }}</th><td>{{ $idol->height ?: '? ' }}cm</td>
                    <th>{{ __('Blood type') }}</th><td>{{ $idol->bloodtype ?: __('N/A') }}</td>
                </tr>
                <tr>
                    <th>{{ __('Age') }}</th><td>{{ $idol->age ? $idol->age.(!App::isLocale('en') ? __('years old') : '') : __('N/A')}}</td>
                    <th>{{ __('Weight') }}</th><td>{{ $idol->weight ?: '? ' }}kg</td>
                    <th>{{ __('Handedness') }}</th><td>{{ __(translateHandedness($idol->handedness)) ?: __('N/A') }}</td>
                </tr>
                <tr>
                    <th>{{ __('Birthplace') }}</th><td><a href="{{ url('/search').'?birthplace='.$idol->birthplace }}">{{ __('place.pref.'.($idol->birthplace ?: '不明')) }}</a></td>
                    <th>BMI</th><td>{{ calcBmi($idol->height,$idol->weight) ?: __('N/A') }}</td>
                    <th>{{ __('3 size') }}</th><td>{{ $idol->bust ? $idol->bust.' / '.$idol->waist.' / '.$idol->hip : __('N/A') }}</td>
                </tr>
                <tr>
                    <th>{{ __('Hobby') }}</th>
                    <td colspan="5" class="ja">
                        <?php if(!App::isLocale('ja') && !empty($idol->hobby)) echo genTranslationLink($idol->hobby,App::getLocale()) ?>
                        {{ $idol->hobby ?: __('N/A') }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Skill') }}</th>
                    <td colspan="5" class="ja">
                        <?php if(!App::isLocale('ja') && !empty($idol->skill)) echo genTranslationLink($idol->skill,App::getLocale()) ?>
                        {{ $idol->skill ?: __('N/A') }}
                    </td>
                </tr>
                <tr>
                    <th>{{ __('Favorite') }}</th>
                    <td colspan="5" class="ja">
                        <?php if(!App::isLocale('ja') && !empty($idol->favorite)) echo genTranslationLink($idol->favorite,App::getLocale()) ?>
                        {{ $idol->favorite ?: __('N/A') }}
                    </td>
                </tr>
            </table>
            <div id="idollinks">
                <div>
                    <h2>{{ __('Encyclopedia') }}</h2>
                    <div class="buttonbox">
                        <a href="https://dic.nicovideo.jp/a/{{ urlencode($idol->name) }}" class="button jwil" target="_blank">
                            {{ __('niconico Pedia') }}
                        </a>
                        <a href="https://dic.pixiv.net/a/{{ urlencode($idol->name) }}" class="button jwil" target="_blank">
                            {{ __('pixiv encyclopedia (ja)') }}
                        </a>
                    </div>
                </div>
                <div>
                    <h2>{{ __('Musics info') }}</h2>
                    <div class="buttonbox">
                        <a href="https://fujiwarahaji.me/idol/765/{{ $idol->name_r }}" class="button jwil" target="_blank">
                            {{ __('fujiwarahaji.me') }}
                            <span class="subline">{{ __('THE IDOLM@STER Musics DB') }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="twinbox">
        <div id="contentwide">
            <div class="msgbox">
                <div class="msgboxtop">{{ __('mediasearch.title') }}</div>
                <div class="msgboxbody">
                    <h2>{{ __('mediasearch.twitter') }}</h2>
                    <div class="buttonbox">
                        <a href="https://twitter.com/search?q={{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f50e; {{ __('mediasearch.twitter.normal') }}<br><span class="subline">{{ __('mediasearch.twitter.normal.desc') }}</span>
                        </a>
                        <a href="https://twitter.com/search?f=live&q={{ $urlname }}" class="button jwil" target="_blank">
                            &#x231a; {{ __('mediasearch.twitter.realtime') }}<br><span class="subline">{{ __('mediasearch.twitter.realtime.desc') }}</span>
                        </a>
                        <a href="https://twitter.com/search?f=user&q={{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f1f5; {{ __('mediasearch.twitter.user') }}<br><span class="subline">{{ __('mediasearch.twitter.user.desc') }}</span>
                        </a>
                        <a href="https://twitter.com/search?f=image&q={{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f4f7; {{ __('mediasearch.twitter.image') }}<br><span class="subline">{{ __('mediasearch.twitter.image.desc') }}</span>
                        </a>
                        <a href="https://twitter.com/search?f=video&q={{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f4f9; {{ __('mediasearch.twitter.video') }}<br><span class="subline">{{ __('mediasearch.twitter.video.desc') }}</span>
                        </a>
                        <a href="https://azure-gallery.net/?query=imas%3A{{ $urlname }}" class="button jwil" target="_blank">
                            &#x2693; {{ __('mediasearch.twitter.azure') }}<br><span class="subline">{{ __('mediasearch.twitter.azure.desc') }}</span>
                        </a>
                    </div>
                    <p class="notification">
                        {{ __('mediasearch.twitter.notice.0') }}<br>
                        {{ __('mediasearch.twitter.notice.1') }}
                    </p>
                    <h2>{{ __('mediasearch.niconico') }}</h2>
                    <div class="buttonbox">
                        <a href="http://www.nicovideo.jp/search/{{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f4fa; {{ __('mediasearch.niconico.keyword') }}
                        </a>
                        <a href="http://www.nicovideo.jp/tag/{{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f4fa; {{ __('mediasearch.niconico.tag') }}
                        </a>
                        <a href="http://seiga.nicovideo.jp/tag/{{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f3a8; {{ __('mediasearch.niconico.seiga') }}
                        </a>
                    </div>
                    <h2>{{ __('mediasearch.pixiv') }}</h2>
                    <div class="buttonbox">
                        <a href="https://www.pixiv.net/search.php?s_mode=s_tag_full&word={{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f3a8; {{ __('mediasearch.pixiv.tag') }}<br><span class="subline">{{ __('mediasearch.pixiv.tag.desc') }}</span>
                        </a>
                        <a href="https://www.pixiv.net/search.php?s_mode=s_tc&word={{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f3a8; {{ __('mediasearch.pixiv.keyword') }}<br><span class="subline">{{ __('mediasearch.pixiv.keyword.desc') }}</span>
                        </a>
                        <a href="https://www.pixiv.net/novel/tags.php?tag={{ $urlname }}" class="button jwil" target="_blank">
                            &#x1f4dd; {{ __('mediasearch.pixiv.novel') }}<br><span class="subline">{{ __('mediasearch.pixiv.novel.desc') }}</span>
                        </a>
                    </div>
                </div>
                <div class="msgboxfoot"></div>
            </div>
        </div>
        <div id="contentnarrow">
            <div class="msgbox">
                <div class="msgboxtop">TheaterDays info</div>
                <div class="msgboxbody">
                    <h2>{{ __('messages.idol.show.mltd.ja') }}</h2>
                    <div class="buttonbox">
                        <a href="https://mltd.matsurihi.me/cards/#idol-list-{{ $idol->id }}" class="button jwil" target="_blank">
                            {{ __('messages.idol.show.mltd.ja.cards') }}
                            <span class="subline">matsurihi.me Fantasia</span>
                        </a>
                    </div>
                    <h2>{{ __('messages.idol.show.mltd.oversea') }}</h2>
                    @if(!empty($idol->cknameid))
                        <div class="buttonbox">
                            <a href="https://mltd.matsurihi.me/zh/cards/#idol-list-{{ $idol->id }}" class="button jw" target="_blank">
                                Chinese
                            </a>
                            <a href="https://mltd.matsurihi.me/ko/cards/#idol-list-{{ $idol->id }}" class="button jw" target="_blank">
                                Korean
                            </a>
                        </div>
                    @else
                        <p class="notice">{{ __('messages.idol.show.mltd.oversea.none') }}</p>
                    @endif
                </div>
                <div class="msgboxfoot"></div>
            </div>
            <div class="msgbox">
                <div class="msgboxtop">GREEm@s info</div>
                <div class="msgboxbody">
                    @if(empty($idol->greemas_type))
                        <p class="notice">
                            {{ __('messages.idol.show.gree.none') }}
                        </p>
                    @else
                        <div class="buttonbox">
                            <a href="https://mill.tokyo/?idol={{ genMillTokyoLinkText($idol->name_r,$idol->name_r_separate) }}"
                               class="button jwil" target="_blank">MillionLive Cards<span class="subline">mill.tokyo</span></a>
                        </div>
                    @endif
                </div>
                <div class="msgboxfoot"></div>
            </div>
        </div>
    </div>

@endsection
