<?php  
    include "includes/header_fretes.php";
?>  
    <script src="Highcharts-6.2.0/code/highcharts.js"></script>
    <script src="Highcharts-6.2.0//code/modules/exporting.js"></script>
    <script src="Highcharts-6.2.0//code/modules/export-data.js"></script>

<div style="height: 200px"></div>

<a href="fretes.php"><div style="position: absolute; left: 25px; top:30px">Voltar</div></a>
<div id="container" style="width: 50%; margin-right: 50px;"></div>


    <?php  
        $con = new PDO("mysql:host=localhost;dbname=ff;charset=UTF8", "root", "");
        $rs = $con->prepare("select cast(max(ent_dthr) as date) as dt from frete where motorista = ? or contratante = ?");
        
        $cpf        = isset($_SESSION['usuario']['dados']['cpf'])  ? $_SESSION['usuario']['dados']['cpf']  : '0';
        $cnpj       = isset($_SESSION['usuario']['dados']['cnpj']) ? $_SESSION['usuario']['dados']['cnpj'] : '0';
        $fl_usuario = $_SESSION['usuario']['fl_tipo'];

        if ($fl_usuario=="C") {
            $GROUP = "motorista";
        }else
            $GROUP = "contratante";

        $rs->bindParam(1, $cpf);
        $rs->bindParam(2, $cnpj);
        if($rs->execute()){
            if(!($rs->rowCount())){
                echo "Não foram encontrados registros";
                die();
            }
        }
        $row = $rs->fetch(PDO::FETCH_OBJ);

        $rs2= $con->prepare("SELECT
                                format(sum(valor),2)  as sumValor,
                                format(avg(valor),2)  as medValor,
                                'Valor (R$)' as tipo
                            FROM frete f
                              WHERE
                                (f.motorista= $cpf or f.contratante= $cnpj)
                                and f.ent_dthr is not null
                            GROUP BY
                                $GROUP
                            UNION ALL
                            SELECT
                              format(sum(peso),2)   as sumValor,
                              format(avg(peso),2)   as medValor,
                              'Peso (Kgs)' as tipo
                            FROM frete f
                              WHERE
                                (f.motorista= $cpf or f.contratante= $cnpj)
                                and f.ent_dthr is not null
                            GROUP BY
                                $GROUP
                            UNION ALL
                            SELECT
                              format(sum(volume),2) as sumValor,
                              format(avg(volume),2) as medValor,
                              'Volume (m³)' as tipo
                            FROM frete f
                              WHERE
                                (f.motorista= $cpf or f.contratante= $cnpj)
                                and f.ent_dthr is not null
                            GROUP BY
                              $GROUP"
                          );
        
        if(!($rs2->execute())){
            echo "<pre>";
            print_r($rs2->errorInfo());
            echo "</pre>";
        }

    ?>
    <script type="text/javascript">
        Highcharts.chart('container', {
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Relatórios das cargas finalizadas até <?=$row->dt?>'
            },
            subtitle: {
                text: 'Biblioteca utilizada: <a href="https://www.highcharts.com/">Highcharts</a>'
            },
            xAxis: {
                categories: ['Total', 'Médias'],
                title: {
                    text: null
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Unidades de medida (milhares)',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
                valueSuffix: ' milhares'
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'left',
                verticalAlign: 'top',
                x: 0,
                y: 0,
                floating: true,
                borderWidth: 1,
                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [
            <?php  
            while ($row2 = $rs2->fetch(PDO::FETCH_OBJ)){
                echo "{\n";
                echo "\t\tname:  '"   . $row2->tipo. "',\n";
                echo "\t\tdata:   [" . str_replace(",", "",$row2->sumValor) . ", " . str_replace(",", "",$row2->medValor) . "]\n";
                echo "\t\t},\n";
            }
            ?>
            ]
        });
    </script>
	</body>
</html>