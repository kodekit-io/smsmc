@extends('layouts.default')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-card uk-card-hover uk-card-default uk-card-body uk-width-1-1">
            <h2 class="uk-card-title">MONITORING</h2>
            <hr>
            <div class="uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m" uk-grid>
                <div>
                    <h6>1.	ALL MEDIA</h6>
                    <p>Summary data dari keseluruhan channel social media yang menangkap percakapan sesuai dengan keyword / kata kunci.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Brand Equity :</dt>
                        <dd>Menjelaskan perbandingan antara Net Sentiment & Sim Score yang juga menunjukan posisi brand dibandingkan dengan kompetitor.<br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Net Sentiment = Jumlah percakapan dengan sentimen positif ditambah jumlah percakapan dengan sentimen netral dikurangi jumlah percakapan dengan sentimen negatif.</li>
                                <li>Earned Media Share of Voice (EMS) = Konsepnya hampir sama dengan Brand Talkable Favourability (BTF). Yaitu mengukur jumlah buzz dibandingkan dengan setiap channel media berbanding dengan kompetitornya.</li>
                            </ul>
                        </dd>
                        <dt>B.	Sentiment :</dt>
                        <dd>Penggolongan percakapan yang menggambarkan reaksi user pada saat melakukan percakapan. Sentiment dibagi dengan 3 reaksi yaitu Positif, Negatif dan Netral.</dd>
                        <dt>C.	Sentiment Trend:</dt>
                        <dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>D.	Post Trend:</dt>
                        <dd>Grafik yang menunjukan jumlah tren jumlah posting percakapan berdasarkan jumlah posting dalam periode waktu tertentu.</dd>
                        <dt>E.	Buzz Trend:</dt>
                        <dd>Grafik yang menunjukan jumlah tren total percakapan termasuk dengan jumalh interaksi dalam periode waktu tertentu</dd>
                        <dt>F.	Reach Trend:</dt>
                        <dd>Grafik yang menunjukan jumlah akun percakapan yang telah tertangkap dalam periode waktu tertentu</dd>
                        <dt>G.	Interaction Trend:</dt>
                        <dd>Grafik yang menunjukan jumlah tren interaksi dari percakapan dalam periode waktu tertentu.</dd>
                        <dt>H.	Post :</dt>
                        <dd>Merupakan satuan dari jumlah percakapan.</dd>
                        <dt>I.	Buzz :</dt>
                        <dd>Jumlah total keseluruhan percakapan dalam keyword yang telah tertangkap oleh system.</dd>
                        <dt>J.	Interaction :</dt>
                        <dd>Merupakan jumlah interaksi / impact dari percakapan tersebut.</dd>
                        <dt>K.	Unique User:</dt>
                        <dd>Jumlah akun yang ikut dalam percakapan.</dd>
                        <dt>L.	Interaction Rate :</dt>
                        <dd>Jumlah rata - rata dari jumlah posting percakapan dibanding dengan jumlah interaksi yang terjadi.</dd>
                        <dt>M.	Share of Media:</dt>
                        <dd>Diagram menunjukan jumlah buzz dari suatu brand yang didapatkan dari setiap media channel (Twitter, FB, Online News, Forum, Blog, Video & Instagram)</dd>
                        <dt>N.	Topic Distribution :</dt>
                        <dd>Pengelompokkan percakapan yang telah ditangkap dengan keyword tertentu menjadi topik yang akan dianalisa.</dd>
                        <dt>O.	Ontology :</dt>
                        <dd>Merupakan sebuah diagram yang menggambarkan akun - akun yang terlibat dalam suatu topik / isu tertentu.</dd>
                        <dt>P.	Wordcloud :</dt>
                        <dd>Kumpulan dari keyword - keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>Q.	Conversation List :</dt>
                        <dd>Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam Tab All Media ini list percakapan diperlihatkan dengan sub-tab dari channel lainnya yaitu Facebook, Twitter, News, Int News, Blog, Forum, Video dan Instagram. Detail setiap Sub-Tab akan dijelaskan pada bagian setiap channel.</dd>
                    </dl>
                </div>
                <div>
                    <h6>2.	FACEBOOK</h6>
                    <p>Data percakapan yang ditangkap berdasarkan Facebook Fan Pages yang telah dimasukkan ke dalam system. Keseluruhan data yang ditangkap adalah percakapan yang telah diposting oleh Facebook Fan Pages itu dan juga netizen yang memposting di komentar serta men-tag Facebook Fan Pages tersebut (Owned & Earned Data), selain itu jumlah pengukuran yang bisa ditampilkan adalah jumlah like, comment, dan share. Sehingga isi dari data yang ditangkap bisa diukur kuantitatif dan kualitatifnya.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Sentiment Trend:</dt>
                        <dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>B.	Post Trend:</dt>
                        <dd>Grafik yang menunjukan jumlah tren jumlah posting percakapan berdasarkan jumlah posting dalam periode waktu tertentu.</dd>
                        <dt>C.	Post :</dt>
                        <dd>Merupakan satuan jumlah percakapan dari Facebook Fan Pages dan juga yang men-tag Facebook Fan Pages.</dd>
                        <dt>D.	Comment :</dt>
                        <dd>Merupakan satuan jumlah percakapan yang berkomentar pada posting dari Facebook Fan Pages.</dd>
                        <dt>E.	Like :</dt>
                        <dd>Merupakan satuan jumlah user yang menyukai posting percakapan dari keseluruhan data yang telah ditangkap.</dd>
                        <dt>F.	Share :</dt>
                        <dd>Merupakan satuan jumlah user yang membagikan kembali posting percakapan dari keseluruhan data yang telah ditangkap.</dd>
                        <dt>G.	Sentiment :</dt>
                        <dd>Penggolongan percakapan yang menggambarkan reaksi user pada saat melakukan percakapan. Sentiment dibagi dengan 3 reaksi yaitu Positif, Negatif dan Netral.</dd>
                        <dt>H.	Sentiment Trend:</dt>
                        <dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu.</dd>
                        <dt>I.	Topic Distribution :</dt>
                        <dd>Pengelompokkan percakapan yang telah ditangkap dengan keyword tertentu menjadi topik yang akan dianalisa.</dd>
                        <dt>J.	Ontology :</dt>
                        <dd>Merupakan sebuah diagram yang menggambarkan akun - akun yang terlibat dalam suatu topik / isu tertentu.</dd>
                        <dt>K.	Wordcloud :</dt>
                        <dd>Kumpulan dari keyword - keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>L.	Influencer :</dt>
                        <dd>Merupakan perhitungan percakapan yang terbaik berdasarkan jumlah like dan/atau share terbanyak. Dalam list Influencer pada Facebook ini dibagi dalam kategori :<br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Status = ( Status Posting / Percakapan dalam bentuk text yang memiliki jumlah like dan/atau share terbanyak)</li>
                                <li>Photo = ( Percakapan dalam bentuk photo yang memiliki jumlah like dan/atau share terbanyak)</li>
                                <li>Link = ( Percakapan dalam bentuk link menuju web lain yang memiliki jumlah like dan/atau share terbanyak)</li>
                                <li>Video = ( Percakapan dalam bentuk video yang memiliki jumlah like dan/atau share terbanyak)</li>
                            </ul>
                        </dd>
                        <dt>M.	Conversation :</dt>
                        <dd>Merupakan list detail percakapan yang telah tertangkap oleh system.
                        Dalam list conversation pada Facebook ini terdapat beberapa perhitungan pada setiap kolomnya yaitu :<br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Date = Tanggal, hari dan jam percakapan tersebut</li>
                                <li>Author = Nama User yang mengeluarkan percakapan tersebut.</li>
                                <li>Post = Detail isi dari percakapan.</li>
                                <li>Type = Tipe Media yang dikeluarkan (Status / Text, Photo, Link dan Video)</li>
                                <li>Comment = Jumlah Comment yang tertangkap pada 1 percakapan.</li>
                                <li>Like = Jumlah Like yang tertangkap pada 1 percakapan.</li>
                                <li>Share = Jumlah Share yang tertangkap pada 1 percakapan.</li>
                                <li>Sentiment = Reaksi atau sifat dari percakapan tersebut.</li>
                                <li>Status = Ticketing Status (Open, New, Closed)</li>
                                <li>Search Bar = Filtering Conversation List berdasarkan sub-keyword yang diinginkan.</li>
                            </ul>
                        </dd>
                    </dl>
                </div>
                <div>
                    <h6>3. TWITTER </h6>
                    <p>Data percakapan yang ditangkap berdasarkan keyword atau kata kunci pada setiap percakapan di Twitter. Dala data percakapan ini jumlah pengukuran yang bisa ditampilkan adalah jumlah posting, Reach (Follower), Original Reach (Follower), Impact / Interaction dan Viral Score.  Sehingga isi dari data yang ditangkap bisa diukur kuantitatif dan kualitatifnya.</p>
                    <dl class="uk-description-list">
                        <dt>A. Sentiment Trend: </dt>
                        <dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>B. Buzz Trend: </dt>
                        <dd>Grafik yang menunjukan jumlah tren total percakapan termasuk dengan jumalh interaksi dalam periode waktu tertentu.</dd>
                        <dt>C. User Trend : </dt>
                        <dd>Grafik yang menunjukkan jumlah unik akun yang melakukan percakapan dalam periode tertentu.</dd>
                        <dt>D. Reach Trend: </dt>
                        <dd>Grafik yang menunjukan jumlah akun percakapan yang telah tertangkap dalam periode waktu tertentu</dd>
                        <dt>E. Buzz : </dt>
                        <dd>Jumlah total keseluruhan percakapan dalam keyword yang telah tertangkap oleh system.</dd>
                        <dt>F. Interaction : </dt>
                        <dd>Merupakan jumlah interaksi / impact dari percakapan tersebut.</dd>
                        <dt>G. Sentiment : </dt>
                        <dd>Penggolongan percakapan yang menggambarkan reaksi user pada saat melakukan percakapan. Sentiment dibagi dengan 3 reaksi yaitu Positif, Negatif dan Netral. </dd>
                        <dt>H. Interaction Trend: </dt>
                        <dd>Grafik yang menunjukan jumlah tren interaksi dari  percakapan dalam periode waktu tertentu.</dd>
                        <dt>I. Topic Distribution : </dt>
                        <dd>Pengelompokkan percakapan yang telah ditangkap dengan keyword tertentu menjadi topik yang akan dianalisa.</dd>
                        <dt>J. Wordcloud : </dt>
                        <dd>Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>K. Ontology : </dt>
                        <dd>Merupakan sebuah diagram yang menggambarkan akun – akun yang terlibat dalam suatu topik / isu tertentu.</dd>
                        <dt>L. Influencer : </dt>
                        <dd>Merupakan perhitungan user yang melakukan percakapan terpopuler. Dalam list Influencer pada Twitter ini dibagi dalam kategori : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Top 10 by Reach = ( Akun yang melakukan Posting / Percakapan yang memiliki jumlah reach terbanyak pada percakapan tersebut)</li>
                                <li>Top 10 by Number of Post = ( Akun yang melakukan posting / Percakapan terbanyak)</li>
                                <li>Top 10 By Impact = ( Akun yang melakukan posting / percakapan yang memiliki jumlah interaksi terbanyak)</li>
                            </ul>
                        </dd>
                        <dt>M. Conversation :  </dt>
                        <dd>Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada Twitter ini terdapat beberapa perhitungan pada setiap kolomnya yaitu:<br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Date = Tanggal, hari dan jam percakapan tersebut </li>
                                <li>Author = Nama User yang mengeluarkan percakapan tersebut.</li>
                                <li>Post = Detail isi dari percakapan.</li>
                                <li>Interaction = Jumlah akun yang berinteraksi pada percakapan tersebut.</li>
                                <li>Original Reach = Jumlah Follower akun pada saat percakapan tersebut dikeluarkan.</li>
                                <li>Viral Reach = Jumlah follower dari akun – akun yang berinteraksi pada percakapan tersebut.</li>
                                <li>Viral Score = Jumlah perbandingan antara Viral Reach dengan jumlah Original Followers</li>
                                <li>Sentiment = Reaksi atau sifat dari percakapan tersebut.</li>
                                <li>Status = Ticketing Status (Open, New, Closed)</li>
                                <li>Search Bar = Filtering Conversation List berdasarkan sub-keyword yang diinginkan.</li>
                            </ul>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

    </section>

@endsection

@section('page-level-scripts')
@endsection
