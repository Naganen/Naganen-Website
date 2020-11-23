<?php
class WMform {
    private $formid = "";
    private $formum = "";
    public function head( $id, $formid = false ) {
        $this->formid = $id;
        $this->formum = $formid;
        if ( $formid != "" ) {
            echo '<form action="javascript:void(0);" id="' . $id . '" class="form' . $formid . '", enctype="multipart/form-data">';
        } //$formid != ""
        else {
            echo '<form action="javascript:void(0);" id="' . $id . '">';
        }
    }
    public function veri( $name, $placeholder = " Değer Giriniz", $type, $col = "", $ek = "", $label = "" ) {
        echo '<div class="form-group">';
        if ( $col != "" ) {
            echo '<div class="col-md-' . $col . '">';
        } //$col != ""
        if ( $label != "" ) {
            echo '<label>' . $label . '</label>';
        } //$label != ""
        echo '<input type="' . $type . '" name="' . $name . '" placeholder="' . $placeholder . '" class="form-control" ' . $ek . ' />';
        if ( $col != "" ) {
            echo '</div>';
        } //$col != ""
        echo '</div>';
    }
    public function textarea( $name, $placeholder = " Değer Giriniz", $rows = 5, $col = "", $ek = "", $label = "", $val = false ) {
        echo '<div class="form-group">';
        if ( $col != "" ) {
            echo '<div class="col-md-' . $col . '">';
        } //$col != ""
        if ( $label != "" ) {
            echo '<label>' . $label . '</label>';
        } //$label != ""
        echo '<textarea name="' . $name . '" rows="' . $rows . '" placeholder="' . $placeholder . '" class="form-control" ' . $ek . '>' . $val . '</textarea>';
        if ( $col != "" ) {
            echo '</div>';
        } //$col != ""
        echo '</div>';
    }
    public function info( $aciklama ) {
        return '<div class="form-group">' . $aciklama . '</div>';
    }
    public function check( $name = "", $value = "", $aciklama = "", $aktif = "", $array = 0 ) {
        if ( $array == 1 ) {
            $arrays = "[]";
        } //$array == 1
        else {
            $arrays = "";
        }
        if ( $aktif == 1 ) {
            $aktiflik = "checked";
        } //$aktif == 1
        else {
            $aktiflik = "";
        }
        echo '<div class="form-group"><input class="icheckbox" type="checkbox" name="' . $name . $arrays . '" value="' . $value . '" ' . $aktiflik . '> &nbsp;' . $aciklama . ' </div>';
    }
    public function buton( $id, $aciklama = " Gönder", $tip = "success", $icon = "arrow-right", $pid = 0, $ek = "" ) {
        echo '<button class="btn btn-' . $tip . '" formid="' . $this->formum . '" name="gonder-' . $id . '" id="' . $this->formid . '" pid="' . $pid . '" ' . $ek . ' onclick="WM_post_et(' . $id . ')"/><i class="fa fa-' . $icon . '"></i> ' . $aciklama . '</button>';
    }
    public function footer( ) {
        echo '</form>';
    }
    public function hata( $icerik = " Bir hata meydana geldi." ) {
?><script>
			modal({
				type: 'error',
				title: '<i class="fa fa-close"></i> Hata ! ',
				text: "<?= $icerik; ?>"
			});</script><?php
    }
    public function basari( $icerik = " İşleminiz başarıyla gerçekleştirildi.", $delay = 4000, $yonlendir = false ) {
?><script>
			modal({
				type: 'success',
				title: '<i class="fa fa-check"></i> Başarı ! ',
				text: "<?= $icerik; ?>"
			});</script><?php
    }
    public function uyari( $icerik ) {
?><script>
			modal({
				type: 'warning',
				title: '<i class="fa fa-warning"></i> Uyarı ! ',
				text: "<?= $icerik; ?>"
			});</script><?php
    }
    public function bilgi( $icerik, $delay = 4000 ) {
?><script>
			modal({
				type: 'alert',
				title: '<i class="fa fa-info-circle"></i> Bilgi ! ',
				text: "<?= $icerik; ?>"
			});</script><?php
    }
    public function jquery_sil( $sil ) {
?><script>$('<?= $sil; ?>').attr('style', 'display:none;');</script><?php
    }
    public function jquery_duzelt( $duzelt, $sonuc ) {
?><script>$('<?= $duzelt; ?>').text(<?= $sonuc; ?>);</script><?php
    }
    public function jquery_before( $nere, $eklencek ) {
?><script type="text/javascript">$('<?= $nere ?>').before('<?= $eklencek; ?>');</script><?php
    }
    public function sil_sor( ) {
?><script>return confirm("Silmek İstediğinize Eminmisiniz ? ");</script><?php
    }
}
?>