<div class="canvas">
    <canvas id="myChart" style="min-height: 285px;"></canvas>
</div>
<div class="row text-center will-hide">
    <div class="col-lg-4 col-md-4 mt-3 total-discount"></div>
    <div class="col-lg-4 col-md-4 mt-3 total-ticket"></div>
    <div class="col-lg-4 col-md-4 mt-3 total-income"></div>
</div>

<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // define
        let date = new Date();
        let mm = String(date.getMonth() + 1).padStart(2, '0');
        let yyyy = date.getFullYear();
        $('#month').val(mm);
        $('#year').val(yyyy);

        let labels = [];
        let dataLabels = []

        function getData(month = mm, year = yyyy)
        {
            labels = [];
            dataLabels = [];

            $.ajax({
                type: "POST",
                url: "{{route('render.chart')}}",
                data: {
                    month: month,
                    year: year
                },
                dataType: "json",
                success: function (response) {
                    if(response.label.length > 0) {
                        $.each(response.label, function (index, value) { 
                            labels.push(value)
                        });
                        $.each(response.netto, function (index, value) { 
                            dataLabels.push(value)
                        });
                        
                        let totalTicket = '<h1 class="mb-0 fw-light">'+response.totalTicket+'</h1>'
                            totalTicket += '<small>Jumlah Tiket</small>'
                        let totalDiscount = '<h1 class="mb-0 fw-light">'+response.totalDiscount+'</h1>'
                            totalDiscount += '<small>Total Diskon</small>'
                        let totalIncome = '<h1 class="mb-0 fw-light">'+response.totalIncome+'</h1>'
                            totalIncome += '<small>Total Pendapatan</small>'

                        $('.total-ticket').empty().append(totalTicket)
                        $('.total-discount').empty().append(totalDiscount)
                        $('.total-income').empty().append(totalIncome)

                        let exportButton = '<a class="dropdown-item btn-export" href="javascript:void(0)" data-month='+month+' data-year='+year+'>'
                            exportButton += '<span class="mdi mdi-printer-3d"></span> Export Table </a>'
                        $('.export').empty().append(exportButton);
                        
                        renderChart(labels, dataLabels)
                        $('.will-hide').prop('hidden', false)
                        $('.export-menu').prop('hidden', false)
                    } else {
                        $('.will-hide').prop('hidden', true)
                        $('.export-menu').prop('hidden', true)
                        $('.canvas').empty().append('<h3 class=text-center>Tidak ada pengunjung pada tanggal ini</h3>')
                    }
                },
                error: function (error) {
                    console.log(error)
                }
            });
        }
        var myChart
        // function done(){
        //     var url=myChart.toBase64Image();
        //     document.getElementById("url").src=url;
        // }
        
        function renderChart(label = [], dataChart = [])
        {
            const labels = label;
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: dataChart,
                }]
            };
            const config = {
                // type: 'line',
                type: 'bar',
                data: data,
                options: {
                    // animation: {
                    //     onComplete: done
                    // }
                }
            };

            myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
            // var myChart = new Chart(
            //     document.getElementById('myChart'),
            //     config
            // );
        }
        // renderChart(labels, dataLabels);
        $('#month').on('change', function(){
            let month = $(this).val();
            let year = $('select[name=year]').find('option:selected').val();
            $("canvas#myChart").remove();
            $('.canvas').append("<canvas id=myChart style='min-height: 285px;'></canvas>")
            getData(month, year)
        });

        $('#year').on('change', function(){
            let year = $(this).val();
            let month = $('select[name=month]').find('option:selected').val();
            $("canvas#myChart").remove();
            $('.canvas').append("<canvas id=myChart style='min-height: 285px;'></canvas>")
            getData(month, year)
        });

        // print
        $('body').on('click', '.btn-export', function(){
            let month = $(this).data('month');
            let year = $(this).data('year');

            var mode = "iframe"; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close,
                popTitle: 'Sistem Informasi Eksekutif Desa Ceking'
            };
            $.ajax({
                type: "POST",
                url: "{{route('export')}}",
                data: {
                    month: month,
                    year: year
                },
                dataType: "json",
                success: function (response) {
                    document.title= 'Laporan - ' + new Date().toJSON().slice(0,10).replace(/-/g,'/')
                    $(response.data).find("div.printableArea").printArea(options);
                }
            });
        });


        getData();
    });
</script>