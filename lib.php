<?php
$db_host = "localhost";
$db_user = "suin";
$db_pass = "ansckd1";
$db_name = "suin";

function sql_connect($db_host, $db_user, $db_pass, $db_name)
{

    $result = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());

	mysql_select_db("suin") or die(mysql_error());

	mysql_query("SET CHARACTER SET utf8");

	return $result;
}

function sql_query($sql)
{	
	
	global $connect;

    $result = @mysql_query($sql, $connect) or 
	die("<p>$sql</p>" . mysql_errno() . " : " .  mysql_error() . "<p>file : $_SERVER[PHP_SELF]" );
	return $result;
}
//사용하지 않음
function sql_total($sql)
{
    global $connect;
    $result_total = sql_query($sql, $connect);
    $data_total = mysql_fetch_array($result_total);
    $total_count = @$data_total[cnt];
    return $total_count;
}

//페이지를 구한다
function paging($page, $page_row, $page_scale, $total_count, $ext = '')
{
    $total_page  = ceil($total_count / $page_row);
    $paging_str = "";
    
	if ($page > 1) {
        $paging_str .= "<a href='".$_SERVER["PHP_SELF"]."?page=1&'".$ext."><<처음</a>";
    }
    $start_page = ( (ceil( $page / $page_scale ) - 1) * $page_scale ) + 1;
    $end_page = $start_page + $page_scale - 1;

	if ($end_page >= $total_page) $end_page = $total_page;
   
	if ($start_page > 1){
        $paging_str .= " &nbsp;<a href='".$_SERVER["PHP_SELF"]."?page=".($start_page - 1)."&'".$ext.">◀이전</a>";
    }

    if ($total_page > 1) {
        for ($i=$start_page;$i<=$end_page;$i++) {
            if ($page != $i){
		
                $paging_str .= " [&nbsp;<b><a href='board_list.php?page=".$i."&' ".$ext."><span>$i</span></a></b>&nbsp;]";
            }else{
				
                $paging_str .= " [&nbsp;$i&nbsp;] ";
            }
        }
    }

    if ($total_page > $end_page){
        $paging_str .= " &nbsp;<a href='".$_SERVER["PHP_SELF"]."?page=".($end_page + 1)."&'".$ext.">▶다음</a>";
    }
    if ($page < $total_page) {
        $paging_str .= " &nbsp;<a href='board_list.php?page=".$total_page."&'".$ext.">맨끝>></a>";
    }
    return $paging_str; 

}
?>