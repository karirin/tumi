@extends('layouts.top')
@section('title', 'pair code')
@section('header')
@parent
@endsection
@section('content')


<body>
        <div style="width: 30%;height: 30%;">
                <canvas id="tumi"></canvas>
        </div>
        <input type="button" class="chart_btn" value="月別">

        <span id="year_pulldown"></span>
        <span id="month_pulldown"></span>
        <span id="day_pulldown"></span>
</body>

</html>
@endsection
@section('footer')
@parent
<script>
        window.onload = function() {
                const tumis = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
                const tumi_keys = Object.keys(tumis); // それぞれのkeyを取得
                const day = [];
                const tumi_number = [];
                /* ///////////////////////// */


                /*      　　　日間　          */


                /* ///////////////////////// */

                // for (var $i = 0; $i < 31; $i++) {
                //         tumi_number[$i] = 0;
                // }
                // tumi_keys.forEach(el => {
                //         const tumi_data = Object.values(tumis[el]);
                //         if (tumi_data[4] == 2023 && tumi_data[5] == 1) {
                //                 tumi_number[tumi_data[6] - 1]++;
                //         }
                // });
                // let context = document.querySelector("#tumi").getContext('2d');
                // new Chart(context, {
                //         type: 'line',
                //         data: {
                //                 labels: ['1日', '2日', '3日', '4日', '5日', '6日', '7日', '8日', '9日', '10日', '11日', '12日', '13日', '14日', '15日', '16日', '17日', '18日', '19日', '20日', '21日', '22日', '23日', '24日', '25日', '26日', '27日', '28日', '29日', '30日', '31日'],
                //                 datasets: [{
                //                         label: "2023年",
                //                         data: tumi_number,
                //                         borderColor: '#ff6347',
                //                         backgroundColor: '#ff6347',
                //                 }]
                //         }
                // });

                /* ///////////////////////// */


                /*      　　　月間　          */


                /* ///////////////////////// */

                for (var $i = 0; $i < 12; $i++) {
                        tumi_number[$i] = 0;
                }
                tumi_keys.forEach(el => {
                        const tumi_data = Object.values(tumis[el]);
                        if (tumi_data[4] == 2023) {
                                tumi_number[tumi_data[5] - 1]++;
                        }
                });
                let context = document.querySelector("#tumi").getContext('2d');
                myChart = new Chart(context, {
                        type: 'line',
                        data: {
                                labels: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                                datasets: [{
                                        label: "2023年",
                                        data: tumi_number,
                                        borderColor: '#ff6347',
                                        backgroundColor: '#ff6347',
                                }]
                        }
                });

                $(function() {
                        // 現在日時
                        var current = new Date();

                        var year_val = current.getFullYear();
                        var month_val = current.getMonth() + 1;

                        // プルダウン生成
                        $('#year_pulldown').html('<select name="year">');
                        // 昇順
                        for (var i = 2023; i <= year_val + 1; i++) {
                                $('#year_pulldown select').append('<option value="' + i + '">' + i + '</option>');
                        }
                        $('#year_pulldown').append('年');

                        $('#month_pulldown').html('<select name="month">');
                        for (var i = 1; i <= 12; i++) {
                                $('#month_pulldown select').append('<option value="' + i + '">' + i + '</option>');
                        }
                        $('#month_pulldown').append('月');

                        // デフォルト
                        $('select[name=year] option[value=' + year_val + ']').prop('selected', true);
                        $('select[name=month] option[value=' + month_val + ']').prop('selected', true);
                });
        }

        $(document).on('click', ".chart_btn", function() {
                $.ajaxSetup({
                        headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                });
                if (myChart) {
                        myChart.destroy();
                }
                $.ajax({}).done(function(data) {
                        const tumis = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
                        const tumi_keys = Object.keys(tumis); // それぞれのkeyを取得
                        const day = [];
                        const tumi_number = [];
                        if ($('.chart_btn').val() == '月別') {
                                $year = $('[name=year]').val();
                                $month = $('[name=month]').val();
                                $('.chart_btn').val('日別');
                                for (var $i = 0; $i < 31; $i++) {
                                        tumi_number[$i] = 0;
                                }
                                tumi_keys.forEach(el => {
                                        const tumi_data = Object.values(tumis[el]);
                                        if (tumi_data[4] == $year && tumi_data[5] == $month) {
                                                tumi_number[tumi_data[6] - 1]++;
                                        }
                                });
                                let context = document.querySelector("#tumi").getContext('2d');
                                myChart = new Chart(context, {
                                        type: 'line',
                                        data: {
                                                labels: ['1日', '2日', '3日', '4日', '5日', '6日', '7日', '8日', '9日', '10日', '11日', '12日', '13日', '14日', '15日', '16日', '17日', '18日', '19日', '20日', '21日', '22日', '23日', '24日', '25日', '26日', '27日', '28日', '29日', '30日', '31日'],
                                                datasets: [{
                                                        label: $year + '年' + $month + '月',
                                                        data: tumi_number,
                                                        borderColor: '#ff6347',
                                                        backgroundColor: '#ff6347',
                                                }]
                                        }
                                });
                        } else {
                                $year = $('[name=year]').val();
                                $('.chart_btn').val('月別');
                                for (var $i = 0; $i < 12; $i++) {
                                        tumi_number[$i] = 0;
                                }
                                tumi_keys.forEach(el => {
                                        const tumi_data = Object.values(tumis[el]);
                                        if (tumi_data[4] == $year) {
                                                tumi_number[tumi_data[5] - 1]++;
                                        }
                                });
                                let context = document.querySelector("#tumi").getContext('2d');
                                myChart = new Chart(context, {
                                        type: 'line',
                                        data: {
                                                labels: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                                                datasets: [{
                                                        label: $year + '年',
                                                        data: tumi_number,
                                                        borderColor: '#ff6347',
                                                        backgroundColor: '#ff6347',
                                                }]
                                        }
                                });
                        }
                }).fail(function() {});
        });

        $(document).on('change', "#year_pulldown", function() {
                $.ajaxSetup({
                        headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                });
                if (myChart) {
                        myChart.destroy();
                }
                $.ajax({}).done(function(data) {
                        const tumis = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
                        const tumi_keys = Object.keys(tumis); // それぞれのkeyを取得
                        const day = [];
                        const tumi_number = [];
                        if ($('.chart_btn').val() == '月別') {
                                $year = $('[name=year]').val();
                                $month = $('[name=month]').val();
                                $('.chart_btn').val('日別');
                                for (var $i = 0; $i < 31; $i++) {
                                        tumi_number[$i] = 0;
                                }
                                tumi_keys.forEach(el => {
                                        const tumi_data = Object.values(tumis[el]);
                                        if (tumi_data[4] == $year && tumi_data[5] == $month) {
                                                tumi_number[tumi_data[6] - 1]++;
                                        }
                                });
                                let context = document.querySelector("#tumi").getContext('2d');
                                myChart = new Chart(context, {
                                        type: 'line',
                                        data: {
                                                labels: ['1日', '2日', '3日', '4日', '5日', '6日', '7日', '8日', '9日', '10日', '11日', '12日', '13日', '14日', '15日', '16日', '17日', '18日', '19日', '20日', '21日', '22日', '23日', '24日', '25日', '26日', '27日', '28日', '29日', '30日', '31日'],
                                                datasets: [{
                                                        label: $year + '年' + $month + '月',
                                                        data: tumi_number,
                                                        borderColor: '#ff6347',
                                                        backgroundColor: '#ff6347',
                                                }]
                                        }
                                });
                        } else {
                                $year = $('[name=year]').val();
                                $('.chart_btn').val('月別');
                                for (var $i = 0; $i < 12; $i++) {
                                        tumi_number[$i] = 0;
                                }
                                tumi_keys.forEach(el => {
                                        const tumi_data = Object.values(tumis[el]);
                                        if (tumi_data[4] == $year) {
                                                tumi_number[tumi_data[5] - 1]++;
                                        }
                                });
                                let context = document.querySelector("#tumi").getContext('2d');
                                myChart = new Chart(context, {
                                        type: 'line',
                                        data: {
                                                labels: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                                                datasets: [{
                                                        label: $year + '年',
                                                        data: tumi_number,
                                                        borderColor: '#ff6347',
                                                        backgroundColor: '#ff6347',
                                                }]
                                        }
                                });
                        }
                }).fail(function() {});
        });

        $(document).on('change', "#month_pulldown", function() {
                $.ajaxSetup({
                        headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                });
                if (myChart) {
                        myChart.destroy();
                }
                $.ajax({}).done(function(data) {
                        const tumis = @JSON($tumis); //bladeの$array_datasをjavascriptで読み込む
                        const tumi_keys = Object.keys(tumis); // それぞれのkeyを取得
                        const day = [];
                        const tumi_number = [];
                        $year = $('[name=year]').val();
                        $month = $('[name=month]').val();
                        $('.chart_btn').val('日別');
                        for (var $i = 0; $i < 31; $i++) {
                                tumi_number[$i] = 0;
                        }
                        tumi_keys.forEach(el => {
                                const tumi_data = Object.values(tumis[el]);
                                if (tumi_data[4] == $year && tumi_data[5] == $month) {
                                        tumi_number[tumi_data[6] - 1]++;
                                }
                        });
                        let context = document.querySelector("#tumi").getContext('2d');
                        myChart = new Chart(context, {
                                type: 'line',
                                data: {
                                        labels: ['1日', '2日', '3日', '4日', '5日', '6日', '7日', '8日', '9日', '10日', '11日', '12日', '13日', '14日', '15日', '16日', '17日', '18日', '19日', '20日', '21日', '22日', '23日', '24日', '25日', '26日', '27日', '28日', '29日', '30日', '31日'],
                                        datasets: [{
                                                label: $year + '年' + $month + '月',
                                                data: tumi_number,
                                                borderColor: '#ff6347',
                                                backgroundColor: '#ff6347',
                                        }]
                                }
                        });
                }).fail(function() {});
        });
</script>
@endsection