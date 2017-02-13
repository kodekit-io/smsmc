@extends('layouts.default')
@section('page-level-styles')
@endsection
@section('page-level-nav')
@endsection
@section('content')

    <section class="sm-main sm-nosubnav uk-container uk-container-expand">
        <div class="uk-card uk-card-hover uk-card-default uk-card-small uk-width-1-1">
            <div class="uk-card-header">
                <h1 class="uk-card-title">Glossary</h1>
            </div>
        	<div class="uk-card-body">
                <dl class="uk-description-list">
                    <hr><dt>Net Sentiment (NS)</dt>
                    <dd><p>Net Sentiment (NS) adalah nilai bersih sentiment, yaitu pendapat atau perasaan dari konsumen yang dinyatakan di media sosial, terhadap suatu brand didalam dunia media sosial. Ada 2 (dua) cara penghitungan Net Sentiment (NS), yaitu:</p>
        			<blockquote class="uk-text-small"><strong>NS 1</strong> = Total mention yang positif + Total mention yang netral - Total mention yang negative <strong>NS 2</strong> = Total mention yang positif - Total mention yang negatif</blockquote>
        			<p>Dengan demikian, angka untuk NS1 tentunya lebih besar daripada NS2. Pilihan cara penghitungan tergantung dari kebutuhan brand dalam mengukur Net Sentiment (NS). Setelah ditentukan metoda NS1 atau NS2, kemudian dibuatlah grafik yang menunjukan perubahan Net Sentiment (NS) tersebut dalam kurun waktu tertentu.</p></dd>
        			<hr><dt>Net Brand Reputation (NBR)</dt>
        			<dd><p> Net Brand Reputation (NBR) adalah nilah bersih dari bilangan reputasi brand didalam media sosial. Nilai ini kurang lebih sama dengan Net Promoter Score (NPS). Cara penghitungan Net Brand Reputation (NBR) adalah sebagai berikut:</p>
        			<blockquote class="uk-text-small"><strong>NBR</strong> = % Total mention yang positif - % Total mention yang negatif</blockquote>
        			<p>Penghitungan Net Brand Reputation (NBR) bertujuan untuk menyederhanakan metoda pengukuran loyalitas konsumen terhadap suatu brand. Dengan adanya index ini maka kita bisa fokus kepada menaikan mention yang positif (disebut "promoter") dan mengurangi mention yang negative (disebut "detractors").</p></dd>
        			<hr><dt>Brand Talkable Favourability (BTF)</dt>
        			<dd><p> Brand Talkable Favourability (BTF) adalah pengukuran percakapan suatu brand yang dianggap positif, netral dan negative. Beda antara Brand Talkable Favourability (BTF) dan Net Brand Reputation (NBR) adalah bahwa mention yang netral dianggap baik, karena ikut membicarakan brand. Rumus dari Brand Talkable Favourability (BTF) adalah sebagai berikut:</p>
        			<blockquote class="uk-text-small"><strong>BTF</strong> = (% Total mention yang positif + % Total mention yang netral) - % Total mention yang negatif</blockquote></dd>

        			<hr><dt>Earned Media Share of voice by Sentiment (EMSS)</dt>
        			<dd><p> Earned Media Share of Voice by Sentiment (EMSS) konsepnya sama dengan Brand Talkable Favourability (BTF), tetapi diukur dalam konteks kategori suatu produk. Jadi, denominatornya tidak terbatas kepada percakapan satu brand saja, melainkan percakapan dari semua brand yang ada dalam kategori produk tersebut. Rumus dari Earned Media Share of Voice by Sentiment (EMSS) adalah sebagai berikut:</p>
        			<blockquote class="uk-text-small"><strong>EMSS</strong> = (% Total mention yang positif dari brand / % Total mention positif dari kategori) = (% Total mention yang netral dari brand / % Total mention yang netral dari kategori) - (% Total mention yang negatif dari brand / % Total mention yang negatif dari kategori)</blockquote></dd>
        			<hr><dt>Social Influence Marketing (SIM)</dt>
        			<dd><p>Social Influence Marketing (SIM) adalah suatu index yang mengukur pengaruh dari suatu brand dalam media sosial. Rumus dari Social Influence Marketing (SIM) adalah sebagai berikut:</p>
        			<blockquote class="uk-text-small"><strong>SIM SCORE</strong> = (% Total mention yang positif dari brand / % Total mention dari kategori) + (% Total mention yang netral dari brand / % Total mention dari kategori) - (% Total mention yang negatif dari brand / % Total mention dari kategori)</blockquote></dd>
        			<hr><dt>Buzz (BZ)</dt>
        			<dd><p>Buzz adalah percakapan yang terjadi atas suatu brand di media sosial</p></dd>
        			<hr><dt>Unique User (UU)</dt>
        			<dd><p>Unique User adalah jumlah orang yang mempercakapkan tentang brand di media sosial, tetapi bukan jumlah percakapannya. Jadi, seseorang yang sama bisa membicarakan brand yang berbeda atau brand yang sama, beberapa kali. Dengan perhitungan ini maka kita bisa menghitung jumlah orang yang mempercakapkan brand atau dikenal dalam media tradisional sebagai "reach".</p></dd>
        			<hr><dt>Sentiment Index (SI)</dt>
        			<dd><p>Sentiment Index adalah suatu indeks yang mengukur margin perbandingan antara sentimen tiap kandidat dibandingkan dengan keseluruhan kandidat. Sentimen indeks bertujuan mengetahui persepsi langsung konsumen atau konstituen kepada setiap kandidat.</p></dd>
        		</dl>
        	</div>
        </div>

    </section>

@endsection

@section('page-level-scripts')
@endsection