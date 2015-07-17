


<table>
    <tr>
        <td>
            <h1>production de cuivre</h1>
            <?
            $a = 0;
            $b = 1;
            $i = 1;
            while($i <= 20)
            {
                $c = $a + $b;
                $a = $b;
                $b = $c;
                $production[$i] = $c*60;
                $i++;
            }
            ?><pre><?print_r($production); ?></pre>
        </td>
        <td>
            <h1>production de carbonne</h1>
            <?
            $a = 0;
            $b = 1;
            $i = 1;
            while($i <= 20)
            {
                $c = $a + $b;
                $a = $b;
                $b = $c;
                $production[$i] = $c*30;
                $i++;
            }
            ?><pre><?print_r($production); ?></pre>
        </td>
        <td>
            <h1>production de produit chimique</h1>
            <?
            $a = 0;
            $b = 1;
            $i = 1;
            while($i <= 20)
            {
                $c = $a + $b;
                $a = $b;
                $b = $c;
                $production[$i] = $c*15;
                $i++;
            }
            ?><pre><?print_r($production); ?></pre>
        </td>
    </tr>

</table>


