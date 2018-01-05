<?php
header("Content-Type: application/rss+xml; charset=ISO-8859-1");
require("db.class.php");
class Feed extends Db{
    public $rssfeed = '';
    function __construct(){$this->feed();}
    function feed(){
        $cc = (date('Y')==2018)?"2018":"2018 -".date('Y');
        $this->rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
        $this->rssfeed .= '<rss version="2.0">';
        $this->rssfeed .= '<channel>';
        $this->rssfeed .= '<title>asSaggi feed</title>';
        $this->rssfeed .= '<link>https://www.assaggidiletteratura.it</link>';
        $this->rssfeed .= '<description>Raccolta di tutte le recensioni del blog</description>';
        $this->rssfeed .= '<language>it-IT</language>';
        $this->rssfeed .= '<copyright>Copyright (C) '.$cc.' asSaggi</copyright>';

        $sql = "select id,titolo, descrizione,inserimento from libri order by inserimento desc;";
        $lista = $this->simpleSql($sql);
        foreach ($lista as $key => $value) {
            $this->rssfeed .= '<item>';
            $this->rssfeed .= '<title>' . $value['titolo'] . '</title>';
            $this->rssfeed .= '<description>' . $value['descrizione'] . '</description>';
            $this->rssfeed .= '<link>https://www.assaggidiletteratura.it/book.php?book='.$value['id'].'</link>';
            $this->rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($value['inserimento'])) . '</pubDate>';
            $this->rssfeed .= '</item>';
        }

        $this->rssfeed .= '</channel>';
        $this->rssfeed .= '</rss>';
     }
}

?>
