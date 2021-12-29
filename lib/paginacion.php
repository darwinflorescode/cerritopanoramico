<?php
//clase de la paginacion del sistema
class paginacion
{
public $connection;
public $total;
public $page;
public $total_page;
public $start_row;
public $item;
public $max_pages;
public $max_rows;
public $step;
public $max;
public $param;
public $btn_first_page;
public $btn_last_page;
public $btn_next_page;
public $btn_back_page;
public $btn_page;
public $btn_active;

public function __construct($connection) {
        $this->btn_first_page = 'Inicio';
        $this->btn_last_page = 'Último';
        $this->btn_next_page = 'Siguiente';
        $this->btn_back_page = 'Atras';
        $this->btn_page = 'Pag. #';
        $this->btn_active = 'active';
    return $this->connection = $connection;
}


public function rowCount($query)
{
$query = $this->connection->prepare($query);
$query->execute();
$this->total = $query->rowCount();
}

public function config($max_pages, $max_rows)
{
    
$this->start_row = 0;
$this->item = 0;
$this->max_pages = $max_pages;
$this->max_rows = $max_rows;
$this->total_page = $this->total / $this->max_rows;

if (isset($_GET["page"]))
{
$this->page = $_GET["page"];
if ($this->page < 0 || !preg_match("/^([0-9])+$/", $this->page))
{
return;
}

$this->start_row = $this->page * $this->max_rows;

$this->item = $_GET["item"];
if ($this->item < 0  || !preg_match("/^([0-9])+$/", $this->item))
{
return;
}

$this->max_pages = $this->max_pages + $this->max_rows;

$this->max = $_GET["max"];
if ($this->max < 0  || !preg_match("/^([0-9])+$/", $this->max))
{
return;
}
$this->max_pages = $this->max;
}


if(isset($_GET["next_page"]))
{
$this->page = $_GET["next_page"];
if ($this->page < 0  || !preg_match("/^([0-9])+$/", $this->page))
{
return;
}

$this->start_row = $this->page * $this->max_rows;

$this->item = $_GET["item"];
if ($this->item < 0  || !preg_match("/^([0-9])+$/", $this->item))
{
return;
}

$this->max = $_GET["max"];
if ($this->max < 0  || !preg_match("/^([0-9])+$/", $this->max))
{
return;
}
$this->max_pages = $this->max + 1;
}

if(isset($_GET["back_page"]))
{
$this->page = $_GET["back_page"] - 1;
if ($this->page < 0  || !preg_match("/^([0-9])+$/", $this->page))
{
return;
}
$this->start_row = $this->page * $this->max_rows;

$this->item = $_GET["item"] - 1;
if ($this->item < 0  || !preg_match("/^([0-9])+$/", $this->item))
{
return;
}
$this->max = $_GET["max"];
if ($this->max < 0  || !preg_match("/^([0-9])+$/", $this->max))
{
return;
}

$this->max_pages = $this->max - 1;
}

if (isset($_GET["previous"]))
{
$this->max_pages = $this->max_pages;
$this->start_row=0;
$this->item = 0;
}
}

public function pages($class='')
{
    
if($this->item >= 1)
{
echo "<li><a class='$class btn btn-default' title='Inicio de Pagina'  href='?previous=1".$this->param."' ><span class='glyphicon glyphicon-th-large'>&nbsp;</span>$this->btn_first_page</a>&nbsp;&nbsp;</li>";
echo "<li><a class='$class btn btn-default' title='Regresar a la Pagina Anterior'  href='?back_page=$this->page&item=$this->item&max=$this->max_pages".$this->param."'><span class='glyphicon glyphicon-backward'>&nbsp;</span>$this->btn_back_page</a>&nbsp;&nbsp;</li>";
}
for($x = $this->item; $x < $this->max_pages; $x++) 
{
while($x * $this->max_rows < $this->total)
{
$p = $x+1;
$this->page == $p-1 ? $active = ' ' . $this->btn_active : $active = null;
echo "<li class='active'><a class='$class$active  btn-primary' style='cursor:pointer;' title='Número de Pagína' href='?page=$x&item=$this->item&max=$this->max_pages".$this->param."'>$p</a>&nbsp;&nbsp;</li>";
break;
}
}

$numbers = $this->page+1;
echo "<li ><a class='$class btn btn-default'  title='Pagína Actual'>$this->btn_page <b>$numbers</b></a> &nbsp;&nbsp;</li>";

if ($this->max_pages * $this->max_rows < $this->total)
{
$this->page = $this->page+1;
$this->item = $this->item + 1;
echo "<li><a class='$class btn-default' title='Ir a la Pagina Siguiente' href='?next_page=$this->page&item=$this->item&max=$this->max_pages".$this->param."'><span class='glyphicon glyphicon-forward'> </span>$this->btn_next_page</a>&nbsp;</li>";

$this->page = round($this->total_page - 1);
$this->item = round($this->total_page - $this->max_pages);
$this->max = round($this->total_page);
echo "<li><a class='$class btn-default' title='Utima Pagina a Mostrar'  href='?page=$this->page&item=$this->item&max=$this->max".$this->param."'><span class='glyphicon glyphicon-exclamation-sign'>&nbsp;</span>$this->btn_last_page</a>&nbsp;&nbsp;</li>"; 
}
}
}
