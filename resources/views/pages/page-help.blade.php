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
                            </li>
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
                        <dt>H.	Interaction Rate:</dt>
                        <dd>Jumlah rata-rata dari jumlah posting percakapan dibanding dengan jumlah interaksi yang tersedia.</dd>
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
                            </li>
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
                            </li>
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
                            </li>
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
                            </li>
                        </dd>
                    </dl>
                </div>
                <div>
                    <h6>4.	NEWS (NATIONAL & INTERNATIONAL)</h6>
                    <p>Data percakapan yang ditangkap berdasarkan keyword atau kata kunci pada setiap artikel berita online. Dalam data percakapan ini jumlah pengukuran yang bisa ditampilkan adalah jumlah posting, Reach (orang yang membaca artikel), Comments (komentar pada artikel berita), Rank (posisi urutan Web pada Alexa Rank), Sehingga isi dari data yang ditangkap bisa diukur kuantitatif dan kualitatifnya.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Sentiment Trend:</dt> <dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>B.	Post Trend:</dt> <dd>Grafik yang menunjukan jumlah total percakapan dalam periode waktu tertentu.</dd>
                        <dt>C.	Comment Trend:</dt> <dd>Grafik yang menunjukan jumlah total komentar dalam berita dalam periode waktu tertentu.</dd>
                        <dt>D.	Post :</dt> <dd>Merupakan satuan jumlah percakapan dari online news international dan/atau national yang mengandung keyword atau kata kunci di dalam artikelnya tersebut.</dd>
                        <dt>E.	Comment :</dt> <dd>Merupakan satuan jumlah percakapan yang berkomentar pada posting dari berita.</dd>
                        <dt>F.	Reach :</dt> <dd>Merupakan jumlah views atau jumlah orang yang membaca artikel berita tersebut.</dd>
                        <dt>G.	Wordcloud :</dt> <dd>Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>H.	Ontology :</dt> <dd>Merupakan sebuah diagram yang menggambarkan akun – akun yang terlibat dalam suatu topik / isu tertentu.</dd>
                        <dt>I.	Influencer :</dt> <dd>Merupakan perhitungan user yang melakukan percakapan terbaik. Dalam list Influencer pada News ini dihitung berdasarkan jumlah reach terbanyak yang menjadi paling populer. </dd>
                        <dt>J.	Conversation :</dt>
                        <dd>Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada News ini terdapat beberapa perhitungan pada setiap kolomnya yaitu : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li> Date = Tanggal, hari dan jam percakapan tersebut </li>
                                <li> Media = Nama Media yang mengeluarkan artikel percakapan tersebut.</li>
                                <li> Post = Detail isi dari percakapan berita.</li>
                                <li> Comments : Jumlah komentar yang terdapat pada link berita tersebut.</li>
                                <li> Reach : Jumlah orang yang melihat artikel berita tersebut.</li>
                                <li> Sentiment = Reaksi atau sifat dari percakapan tersebut.</li>
                                <li> Status = Ticketing Status (Open, New, Closed)</li>
                                <li> Search Bar = Filtering Conversation List berdasarkan sub&#45keyword yang diinginkan.</li>
                            </li>
                        </dd>
                    </dl>
                </div>
                <div>
                    <h6>5.	BLOG </h6>
                    <p>Data percakapan yang ditangkap berdasarkan keyword atau kata kunci pada setiap percakapan artikel blog. Dalam data percakapan ini jumlah pengukuran yang bisa ditampilkan adalah jumlah posting, Reach (orang yang membaca artikel), Comments (komentar pada artikel blog), Rank (posisi urutan Web pada Alexa Rank), Sehingga isi dari data yang ditangkap bisa diukur kuantitatif dan kualitatifnya.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Sentiment Trend:</dt> <dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>B.	Post Trend:</dt> <dd>Grafik yang menunjukan jumlah total percakapan dalam periode waktu tertentu.</dd>
                        <dt>C.	Comment Trend:</dt> <dd>Grafik yang menunjukan jumlah total komentar dalam berita dalam periode waktu tertentu.</dd>
                        <dt>D.	Post :</dt> <dd>Merupakan satuan jumlah percakapan dari artikel blog yang mengandung keyword atau kata kunci di dalam artikelnya tersebut.</dd>
                        <dt>E.	Comment :</dt> <dd>Merupakan satuan jumlah percakapan yang berkomentar pada posting dari berita.</dd>
                        <dt>F.	Reach :</dt> <dd>Merupakan jumlah views atau jumlah orang yang membaca artikel berita tersebut.</dd>
                        <dt>G.	Sentiment :</dt> <dd>Penggolongan percakapan yang menggambarkan reaksi user pada saat melakukan percakapan. Sentiment dibagi dengan 3 reaksi yaitu Positif, Negatif dan Netral.</dd>
                        <dt>H.	Topic Distribution :</dt> <dd>Pengelompokkan percakapan yang telah ditangkap dengan keyword tertentu menjadi topik yang akan dianalisa.</dd>
                        <dt>I.	Wordcloud :</dt> <dd>Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>J.	Ontology :</dt> <dd>Merupakan sebuah diagram yang menggambarkan akun – akun yang terlibat dalam suatu topik / isu tertentu.
                        <dt>K.	Influencer :</dt> <dd>Merupakan perhitungan user yang melakukan percakapan terpopuler. Dalam list Influencer pada Blog ini dihitung berdasarkan jumlah reach terbanyak yang menjadi paling populer. </dd>
                        <dt>L.	Conversation :</dt> <dd>Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada Blog ini terdapat beberapa perhitungan pada setiap kolomnya yaitu : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Date = Tanggal, hari dan jam percakapan tersebut </li>
                                <li>Author = Nama Blog yang mengeluarkan artikel percakapan tersebut.</li>
                                <li>Post = Detail isi dari percakapan blog.</li>
                                <li>Sentiment = Reaksi atau sifat dari percakapan tersebut.</li>
                                <li>Status = Ticketing Status (Open, New, Closed)</li>
                                <li>Search Bar = Filtering Conversation List berdasarkan sub&#45keyword yang diinginkan.</li>
                            </li>
                        </dd>
                    </dl>
                </div>
                <div>
                    <h6>6.	FORUM </h6>
                    <p>Data percakapan yang ditangkap berdasarkan keyword atau kata kunci pada setiap percakapan post thread di forum. Dalam data percakapan ini jumlah pengukuran yang bisa ditampilkan adalah jumlah posting thread, Reach (orang yang membaca thread), Comments (komentar pada artikel thread), Rank (posisi urutan forum pada Alexa Rank), Sehingga isi dari data yang ditangkap bisa diukur kuantitatif dan kualitatifnya.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Sentiment Trend:</dt> <dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>B.	Post Trend:</dt> <dd>Grafik yang menunjukan jumlah total percakapan dalam periode waktu tertentu.</dd>
                        <dt>C.	Comment Trend:</dt> <dd>Grafik yang menunjukan jumlah total komentar dalam berita dalam periode waktu tertentu.</dd>
                        <dt>D.	Sentiment :</dt> <dd>Penggolongan percakapan yang menggambarkan reaksi user pada saat melakukan percakapan. Sentiment dibagi dengan 3 reaksi yaitu Positif, Negatif dan Netral.</dd>
                        <dt>E.	Topic Distribution :</dt> <dd>Pengelompokkan percakapan yang telah ditangkap dengan keyword tertentu menjadi topik yang akan dianalisa.</dd>
                        <dt>F.	Wordcloud :</dt> <dd>Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>G.	Ontology :</dt> <dd>Merupakan sebuah diagram yang menggambarkan akun – akun yang terlibat dalam suatu topik / isu tertentu.</dd>
                        <dt>H.	Influencer :</dt> <dd>Merupakan perhitungan user yang melakukan percakapan terpopuler. Dalam list Influencer pada Forum ini dihitung berdasarkan jumlah reach thread terbanyak yang menjadi paling populer. </dd>
                        <dt>I.	Conversation :</dt> <dd> Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada Blog ini terdapat beberapa perhitungan pada setiap kolomnya yaitu : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Date = Tanggal, hari dan jam percakapan tersebut</li>
                                <li>Media = Nama Forum yang mengeluarkan artikel percakapan tersebut.</li>
                                <li>Post = Detail isi dari percakapan blog.</li>
                                <li>Comments : Jumlah komentar yang terdapat pada link berita tersebut.</li>
                                <li>Reach : Jumlah orang yang melihat artikel berita tersebut.</li>
                                <li>Sentiment = Reaksi atau sifat dari percakapan tersebut.</li>
                                <li>Status = Ticketing Status (Open, New, Closed)</li>
                                <li>Search Bar = Filtering Conversation List berdasarkan sub&#45keyword yang diinginkan.</li>
                            </li>
                        </dd>
                    </dl>
                </div>
                <div>
                    <h6>7.	VIDEO </h6>
                    <p>Data percakapan yang ditangkap berdasarkan keyword atau kata kunci pada setiap judul video di Youtube. Dalam data percakapan ini jumlah pengukuran yang bisa ditampilkan adalah jumlah posting video, Comments (jumlah komentar pada video), Rating (Rating konten pada video dengan urutan 0&#455 yang menunjukkan semakin besar ratingnya semakin baik pula kontennya), Sehingga isi dari data yang ditangkap bisa diukur kuantitatif dan kualitatifnya.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Post Trend</dt> <dd>Grafik yang menunjukan jumlah total percakapan dalam periode waktu tertentu.</dd>
                        <dt>B.	View Trend </dt> <dd>Grafik yang menunjukkan jumlah orang yang melihat video dalam periode waktu tertentu.</dd>
                        <dt>C.	Comment Trend </dt> <dd>Grafik yang menunjukkan jumlah komentar pada video dalam periode waktu tertentu.</dd>
                        <dt>D.	View Count </dt> <dd>Menunjukkan jumlah total orang yang melihat sejumlah video tersebut.</dd>
                        <dt>E.	Comment </dt> <dd>Merupakan satuan jumlah komentar orang pada sejumlah video tersebut.</dd>
                        <dt>F.	Rating </dt> <dd>Merupakan perhitungan rating dari Google mengenai konten dari Video. Rating yang ditunjukkan adalah dari 0 hingga 5 dengan indikasi makin besar ratingnya berarti kontennya makin baik.</dd>
                        <dt>G.	Topic Distribution </dt> <dd>Pengelompokkan percakapan yang telah ditangkap dengan keyword tertentu menjadi topik yang akan dianalisa.</dd>
                        <dt>H.	Wordcloud </dt> <dd>Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>I.	Influencer </dt> <dd>Merupakan perhitungan user yang melakukan percakapan terpopuler. Dalam list Influencer pada Video ini dihitung berdasarkan jumlah Rating tertinggi yang menjadi paling populer</dd>
                        <dt>J.	Conversation </dt> <dd> Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada Video ini terdapat beberapa perhitungan pada setiap kolomnya yaitu : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Date = Tanggal, hari dan jam percakapan tersebut </li>
                                <li>Author = Nama Orang  yang mengeluarkan video tersebut.</li>
                                <li>Video = Detail isi dari judul video.</li>
                                <li>Comments = Jumlah komentar yang terdapat pada link berita tersebut.</li>
                                <li>View = Jumlah orang melihat video tersebut.</li>
                                <li>Sentiment = Reaksi atau sifat dari percakapan tersebut.</li>
                                <li>Status = Ticketing Status (Open, New, Closed)</li>
                                <li>Search Bar = Filtering Conversation List berdasarkan sub&#45keyword yang diinginkan.</li>
                            </li>
                        </dd>
                    </dl>
                </div>
                <div>
                    <h6>8.	INSTAGRAM </h6>
                    <p>Data percakapan yang ditangkap berdasarkan hastag keyword atau kata kunci pada setiap posting di Instagram. Dalam data percakapan ini jumlah pengukuran yang bisa ditampilkan adalah jumlah posting instagram, Comments (jumlah komentar pada post instagram), Love (Jumlah akun yang menyukai posting), Sehingga isi dari data yang ditangkap bisa diukur kuantitatif dan kualitatifnya.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Sentiment Trend:</dt> <dd> yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>B.	Post Trend:</dt> <dd> Grafik yang menunjukan jumlah total percakapan dalam periode waktu tertentu.</dd>
                        <dt>C.	Comment Trend :</dt> <dd> Grafik yang menunjukkan jumlah komentar pada posting instagram dalam periode waktu tertentu.</dd>
                        <dt>D.	Love Trend :</dt> <dd> Grafik yang menunjukkan jumlah orang yang menyukai sejumlah posting instagram tersebut.</dd>
                        <dt>E.	Potential Reach Trend :</dt> <dd> Grafik yang menunjukkan jumlah fans dari akun &#45 akun yang memposting di Instagram yang telah tertangkap datanya berdasarkan periode waktu tertentu.</dd>
                        <dt>F.	Post :</dt> <dd> Merupakan satuan jumlah posting di Instagram yang mengandung hastag keyword atau kata kunci tersebut. </dd>
                        <dt>G.	Love :</dt> <dd> Merupakan satuan jumlah akun yang menyukai posting di Instagram yang telah tertangkap datanya oleh system.</dd>
                        <dt>H.	Sentiment :</dt> <dd> Penggolongan percakapan yang menggambarkan reaksi user pada saat melakukan percakapan. Sentiment dibagi dengan 3 reaksi yaitu Positif, Negatif dan Netral.</dd>
                        <dt>I.	Interaction Rate :</dt> <dd> Jumlah rata – rata dari jumlah posting percakapan dibanding dengan jumlah interaksi yang terjadi.</dd>
                        <dt>J.	Topic Distribution :</dt> <dd> Pengelompokkan percakapan yang telah ditangkap dengan keyword tertentu menjadi topik yang akan dianalisa.</dd>
                        <dt>K.	Wordcloud :</dt> <dd> Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>L.	Ontology :</dt> <dd> Merupakan sebuah diagram yang menggambarkan akun – akun yang terlibat dalam suatu topik / isu tertentu.</dd>
                        <dt>M.	Influencer :</dt> <dd> Merupakan perhitungan user yang melakukan percakapan terpopuler. Dalam list Influencer pada Instagram ini dihitung berdasarkan jumlah Love tertinggi yang menjadi paling populer</dd>
                        <dt>K.	Conversation :</dt> <dd>  Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada Instagram ini terdapat beberapa perhitungan pada setiap kolomnya yaitu : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Date = Tanggal, hari dan jam percakapan tersebut </li>
                                <li>Author = Nama Orang  yang mengeluarkan post instagram tersebut.</li>
                                <li>Post = Detail isi dari Post di Instagram.</li>
                                <li>Comments = Jumlah komentar yang terdapat pada link berita tersebut.</li>
                                <li>Likes / Love = Jumlah orang menyukai post instagram tersebut.</li>
                                <li>Sentiment = Reaksi atau sifat dari percakapan tersebut.</li>
                                <li>Status = Ticketing Status (Open, New, Closed)</li>
                                <li>Search Bar = Filtering Conversation List berdasarkan sub&#45keyword yang diinginkan.</li>
                            </li>
                        </dd>
                    </dl>
                </div>
            </div>
            <h2 class="uk-card-title">SOCIAL MEDIA</h2>
            <hr>
            <div class="uk-child-width-1-1 uk-child-width-1-1@s uk-child-width-1-2@m" uk-grid>
                <div>
                    <h6>1.	FACEBOOK</h6>
                    <p>Data yang ditangkap pada Tab Facebook ini adalah hanya keseluruhan dari Posting Akun Official Facebook Fan Pages yang telah didaftarkan.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Sentiment Trend:</dt><dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>B.	Post Trend:</dt><dd>Grafik yang menunjukan jumlah tren jumlah posting percakapan berdasarkan jumlah posting dalam periode waktu tertentu.</dd>
                        <dt>C.	Post :</dt><dd>Merupakan satuan jumlah percakapan dari Facebook Fan Pages dan juga yang men-tag Facebook Fan Pages.</dd>
                        <dt>D.	Comment :</dt><dd>Merupakan satuan jumlah percakapan yang berkomentar pada posting dari Facebook Fan Pages.</dd>
                        <dt>E.	Like :</dt><dd>Merupakan satuan jumlah user yang menyukai posting percakapan dari keseluruhan data yang telah ditangkap.</dd>
                        <dt>F.	Share :</dt><dd>Merupakan satuan jumlah user yang membagikan kembali posting percakapan dari keseluruhan data yang telah ditangkap.</dd>
                        <dt>G.	Sentiment :</dt><dd>Penggolongan percakapan yang menggambarkan reaksi user pada saat melakukan percakapan. Sentiment dibagi dengan 3 reaksi yaitu Positif, Negatif dan Netral.</dd>
                        <dt>H.	Interaction Rate :</dt><dd>Jumlah rata – rata dari jumlah posting percakapan dibanding dengan jumlah interaksi yang terjadi.</dd>
                        <dt>I.	Wordcloud :</dt><dd>Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>J.	Influencer :</dt><dd>Merupakan perhitungan percakapan yang terpopuler berdasarkan jumlah like dan/atau share terbanyak. Dalam list Influencer pada Facebook ini dibagi dalam kategori : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Status = ( Status Posting / Percakapan dalam bentuk text yang memiliki jumlah like dan/atau share terbanyak)</li>
                                <li>Photo = ( Percakapan dalam bentuk photo yang memiliki jumlah like dan/atau share terbanyak)</li>
                                <li>Link = ( Percakapan dalam bentuk link menuju web lain yang memiliki jumlah like dan/atau share terbanyak)</li>
                                <li>Video = ( Percakapan dalam bentuk video yang memiliki jumlah like dan/atau share terbanyak)</li>
                            </li>
                        </dd>
                        <dt>K.	Conversation :</dt><dd> Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada Facebook ini terdapat beberapa perhitungan pada setiap kolomnya yaitu : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Date = Tanggal, hari dan jam percakapan tersebut </li>
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
                    <h6>2.	TWITTER</h6>
                    <p>Data yang ditangkap pada Tab Twitter ini adalah hanya keseluruhan dari Posting Akun Official Twitter yang telah didaftarkan.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Sentiment Trend:</dt><dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>B.	Buzz Trend:</dt><dd>Grafik yang menunjukan jumlah tren total percakapan termasuk dengan jumalh interaksi dalam periode waktu tertentu.</dd>
                        <dt>C.	User Trend :</dt><dd>Grafik yang menunjukkan jumlah unik akun yang melakukan percakapan dalam periode tertentu.</dd>
                        <dt>D.	Reach Trend:</dt><dd>Grafik yang menunjukan jumlah akun percakapan yang telah tertangkap dalam periode waktu tertentu</dd>
                        <dt>E.	Buzz :</dt><dd>Jumlah total keseluruhan percakapan dalam keyword yang telah tertangkap oleh system.</dd>
                        <dt>F.	Interaction :</dt><dd>Merupakan jumlah interaksi / impact dari percakapan tersebut.</dd>
                        <dt>G.	Viral Reach :</dt><dd>Jumlah total dari follower dari akun – akun yang berinteraksi pada percakapan tersebut.</dd>
                        <dt>A.	Potential Reach :</dt><dd>jumlah folowers dari setiap posting akun official yang telah tertangkap datanya berdasarkan periode waktu tertentu.</dd>
                        <dt>H.	Sentiment :</dt><dd>Penggolongan percakapan yang menggambarkan reaksi user pada saat melakukan percakapan. Sentiment dibagi dengan 3 reaksi yaitu Positif, Negatif dan Netral</dd>
                        <dt>I.	Interaction Rate :</dt><dd>Jumlah rata – rata dari jumlah posting percakapan dibanding dengan jumlah interaksi yang terjadi.</dd>
                        <dt>J.	Wordcloud :</dt><dd>Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>K.	Influencer :</dt><dd>Merupakan perhitungan user yang melakukan percakapan terpopuler. Dalam list Influencer pada Twitter ini dibagi dalam kategori : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Top 10 by Reach = ( Akun Official yang melakukan Posting / Percakapan yang memiliki jumlah reach terbanyak pada percakapan tersebut)</li>
                                <li>Top 10 by Number of Post = ( Akun Official yang melakukan posting / Percakapan terbanyak)</li>
                                <li>Top 10 By Impact = ( Akun Official yang melakukan posting / percakapan yang memiliki jumlah interaksi terbanyak)</li>
                            </ul>
                        </dd>
                        <dt>L.	Conversation :</dt><dd> Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada Twitter ini terdapat beberapa perhitungan pada setiap kolomnya yaitu : <br>
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
                <div>
                    <h6>3.	YOUTUBE</h6>
                    <p>Data yang ditangkap pada Tab Youtube ini adalah hanya keseluruhan dari Posting Akun Official Youtube yang telah didaftarkan.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Post Trend:</dt><dd>Grafik yang menunjukan jumlah total percakapan dalam periode waktu tertentu.</dd>
                        <dt>B.	View Trend :</dt><dd>Grafik yang menunjukkan jumlah orang yang melihat video pada akun official dalam periode waktu tertentu.</dd>
                        <dt>C.	Comment Trend :</dt><dd>Grafik yang menunjukkan jumlah komentar pada video pada akun official dalam periode waktu tertentu.</dd>
                        <dt>D.	View Count :</dt><dd>Menunjukkan jumlah total orang yang melihat sejumlah video di akun official tersebut.</dd>
                        <dt>E.	Comment :</dt><dd>Menunjukkan jumlah total orang yang berkomentar pada akun youtube official.</dd>
                        <dt>F.	Impact :</dt><dd>Menunjukkan jumlah total like dikurangi total dislike.</dd>
                        <dt>G.	Wordcloud :</dt><dd>Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>H.	Influencer :</dt><dd>Merupakan perhitungan user yang melakukan percakapan terpopuler. Dalam list Influencer pada Video ini dihitung berdasarkan jumlah Impact tertinggi yang menjadi paling populer</dd>
                        <dt>I.	Conversation :</dt><dd>Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada Video ini terdapat beberapa perhitungan pada setiap kolomnya yaitu : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Date = Tanggal, hari dan jam percakapan tersebut </li>
                                <li>Author = Nama Orang  yang mengeluarkan video tersebut.</li>
                                <li>Video = Detail isi dari judul video.</li>
                                <li>Comments = Jumlah komentar yang terdapat pada link berita tersebut.</li>
                                <li>View = Jumlah orang melihat video tersebut.</li>
                                <li>Sentiment = Reaksi atau sifat dari percakapan tersebut.</li>
                                <li>Status = Ticketing Status (Open, New, Closed)</li>
                                <li>Search Bar = Filtering Conversation List berdasarkan sub-keyword yang diinginkan.</li>
                            </ul>
                        </dd>
                    </dl>
                </div>
                <div>
                    <h6>4.	INSTAGRAM </h6>
                    <p>Data percakapan yang ditangkap berdasarkan hastag keyword atau kata kunci pada setiap posting di akun official di Instagram. Dalam data percakapan ini jumlah pengukuran yang bisa ditampilkan adalah jumlah posting instagram, Comments (jumlah komentar pada post instagram), Love (Jumlah akun yang menyukai posting), Sehingga isi dari data yang ditangkap bisa diukur kuantitatif dan kualitatifnya.</p>
                    <dl class="uk-description-list">
                        <dt>A.	Sentiment Trend:</dt><dd>Grafik yang menunjukan jumlah tren percakapan berdasarkan jumlah sentiment dalam periode waktu tertentu</dd>
                        <dt>B.	Post Trend:</dt><dd>Grafik yang menunjukan jumlah total percakapan dalam periode waktu tertentu.</dd>
                        <dt>C.	Comment Trend :</dt><dd>Grafik yang menunjukkan jumlah komentar pada posting instagram dalam periode waktu tertentu.</dd>
                        <dt>D.	Love Trend :</dt><dd>Grafik yang menunjukkan jumlah orang yang menyukai sejumlah posting instagram tersebut.</dd>
                        <dt>E.	Potential Reach Trend :</dt><dd>Grafik yang menunjukkan jumlah fans dari akun - akun yang memposting di Instagram yang telah tertangkap datanya berdasarkan periode waktu tertentu.</dd>
                        <dt>F.	Post :</dt><dd>Merupakan satuan jumlah posting di Instagram yang mengandung hastag keyword atau kata kunci tersebut. </dd>
                        <dt>G.	Love :</dt><dd>Merupakan satuan jumlah akun yang menyukai posting di Instagram Official yang telah tertangkap datanya oleh system.</dd>
                        <dt>H.	Comment :</dt><dd>Merupakan satuan jumlah komentar dari keseluruhan posting pada Instagram Official.</dd>
                        <dt>I.	View Count :</dt><dd>Merupakan satuan jumlah view pada video di Instagram.</dd>
                        <dt>J.	Sentiment :</dt><dd>Penggolongan percakapan yang menggambarkan reaksi user pada saat melakukan percakapan. Sentiment dibagi dengan 3 reaksi yaitu Positif, Negatif dan Netral</dd>
                        <dt>K.	Interaction Rate :</dt><dd>Jumlah rata – rata dari jumlah posting percakapan dibanding dengan jumlah interaksi yang terjadi.</dd>
                        <dt>L.	Wordcloud :</dt><dd>Kumpulan dari keyword – keyword yang terbentuk dari keseluruhan percakapan yang telah ditangkap berdasarkan jumlah yang sering muncul. Keyword yang paling sering muncul ditunjukkan dengan ukurannya yang lebih besar dan lebih tebal.</dd>
                        <dt>M.	Influencer :</dt><dd>Merupakan perhitungan user yang melakukan percakapan terpopuler. Dalam list Influencer pada Instagram ini dihitung berdasarkan jumlah Love tertinggi yang menjadi paling populer</dd>
                        <dt>N.	Conversation :</dt><dd> Merupakan list detail percakapan yang telah tertangkap oleh system. Dalam list conversation pada Instagram ini terdapat beberapa perhitungan pada setiap kolomnya yaitu : <br>
                            <ul class="uk-list uk-list-bullet">
                                <li>Date = Tanggal, hari dan jam percakapan tersebut </li>
                                <li>Author = Nama Orang  yang mengeluarkan post instagram tersebut.</li>
                                <li>Post = Detail isi dari Post di Instagram.</li>
                                <li>Comments = Jumlah komentar yang terdapat pada link berita tersebut.</li>
                                <li>Likes / Love = Jumlah orang menyukai post instagram tersebut.</li>
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
