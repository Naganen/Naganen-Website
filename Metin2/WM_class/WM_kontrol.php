<?php
function WM_filtrele( $deger ) {
    return str_replace( array(
         "'",
        "\"",
        "\\&#39;",
        "\\&quot;" 
    ), array(
         "&#39;",
        "&quot;",
        "&#39;",
        "&quot;" 
    ), $deger );
}
class WMcontrol {
    public function WM_html( $form ) {
        $zararsiz = strip_tags( $form );
        $zararsiz = htmlentities( $form );
        $zararsiz = htmlspecialchars( $form );
        return $zararsiz;
    }
    public function WM_post( $form ) {
        $zararsiz = htmlspecialchars( strip_tags( stripslashes( $form ) ) );
        return $zararsiz;
    }
    public function WM_harf_kontrol( $form ) {
        return ( ctype_alpha( $form ) ) ? true : false;
    }
    public function WM_sayi_kontrol( $form ) {
        return ( ctype_digit( $form ) ) ? true : false;
    }
    public function WM_mail( $email ) {
		if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
			return false;
		}
		else{
			return true;
		}
    }
    public function WM_string_int( $deger ) {
        $deger = strip_tags( stripslashes( $deger ) );
        return preg_replace( '/[^a-z-A-Z-0-9ÇİĞÖŞÜçığöşü_]/', '', $deger );
    }
    public function WM_b_harf( $deger ) {
        $deger = strip_tags( stripslashes( $deger ) );
        return preg_replace( '/[^a-z-A-ZÇİĞÖŞÜçığöşü]/', ' ', $deger );
    }
    public function sessions( $deger ) {
        $deger = strip_tags( stripslashes( $deger ) );
        return preg_replace( '/[^ a-z-A-Z-0-9ÇİĞÖŞÜçığöşü._@]/', '', $deger );
    }
    public function WM_char_string( $deger ) {
        $deger = strip_tags( stripslashes( $deger ) );
        $deger = preg_replace( '/[^a-z-A-ZÇİĞÖŞÜçığöşü]/', '', $deger );
        return substr( $deger, 0, 1 );
    }
    public function WM_char_int( $deger ) {
        $deger = strip_tags( stripslashes( $deger ) );
        $deger = preg_replace( '/[^0-9]/', '', $deger );
        return substr( $deger, 0, 1 );
    }
    public function WM_toint( $deger ) {
        return intval( $deger );
    }
    public function WM_tostring( $int ) {
        return strval( $int );
    }
    public function WM_get( $deger ) {
        $gelendeger = htmlspecialchars( strip_tags( stripslashes( $deger ) ) );
        return WM_filtrele( preg_replace( '/[^ a-z-A-Z-0-9ÇİĞÖŞÜçığöşü.,][\'"+_]/', '', $gelendeger ) );
    }
    public function inj( $deger ) {
        $tr  = array(
             '=',
            '+',
            '-',
            '/',
            '&',
            '|',
            '"',
            "'" 
        );
        $eng = array(
             '',
            '',
            '',
            '',
            '',
            '',
            '',
            '' 
        );
        $s   = str_replace( $tr, $eng, $deger );
        return trim( stripslashes( $s ) );
    }
    public function WM_eng( $s ) {
        $tr  = array(
             'ş',
            'Ş',
            'ı',
            'I',
            'İ',
            'ğ',
            'Ğ',
            'ü',
            'Ü',
            'ö',
            'Ö',
            'Ç',
            'ç',
            '(',
            ')',
            '/',
            ':',
            ',',
            '?',
            '*' 
        );
        $eng = array(
             's',
            's',
            'i',
            'i',
            'i',
            'g',
            'g',
            'u',
            'u',
            'o',
            'o',
            'c',
            'c',
            '',
            '',
            '-',
            '-',
            '',
            '',
            '' 
        );
        $s   = str_replace( $tr, $eng, $s );
        $s   = strtolower( $s );
        $s   = preg_replace( '/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s );
        $s   = preg_replace( '/\s+/', '-', $s );
        $s   = preg_replace( '|-+|', '-', $s );
        $s   = preg_replace( '/#/', '', $s );
        $s   = str_replace( '.', '', $s );
        $s   = trim( $s, '-' );
        return $s;
    }
    public function bread( $s ) {
        $d = array(
             '_' 
        );
        $f = array(
             ' ' 
        );
        $s = str_replace( $d, $f, $s );
        return ucwords( $s );
    }
}
?>