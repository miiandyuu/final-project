<?php

namespace App;

class TOPSIS
{
    public $rel_alternatif;
    public $bobot;
    public $atribut;
    public $bobot_normal;
    public $kuadrat;
    public $kuadrat_total;
    public $akar;
    public $normal;
    public $terbobot;
    public $solusi_ideal;
    public $matriks_solusi;
    public $jarak_solusi;
    public $pref;

    function __construct($rel_alternatif, $bobot, $atribut)
    {
        $this->rel_alternatif = $rel_alternatif;
        $this->bobot = $bobot;
        $this->atribut = $atribut;
        $this->bobot_normal();
        $this->normal();
        $this->terbobot();
        $this->solusi_ideal();
        $this->jarak_solusi();
        $this->pref();
        $this->rank = $this->get_rank($this->pref);
    }
    function get_rank($array)
    {
        $data = $array;
        arsort($data);
        $no = 1;
        $new = array();
        foreach ($data as $key => $value) {
            $new[$key] = $no++;
        }
        return $new;
    }
    function bobot_normal()
    {
        $this->bobot_normal = array();
        foreach ($this->bobot as $key => $val) {
            $this->bobot_normal[$key] = $val / array_sum($this->bobot);
        }
    }
    function normal()
    {
        foreach ($this->rel_alternatif as $key => $val) {
            foreach ($val as $k => $v) {
                $this->kuadrat[$key][$k] = $v * $v;
            }
        }
        $this->kuadrat_total = array();
        foreach ($this->kuadrat as $key => $val) {
            foreach ($val as $k => $v) {
                if (!isset($this->kuadrat_total[$k]))
                    $this->kuadrat_total[$k] = 0;
                $this->kuadrat_total[$k] += $v;
            }
        }
        foreach ($this->kuadrat_total as $key => $val) {
            $this->akar[$key] = sqrt($val);
        }
        foreach ($this->rel_alternatif as $key => $val) {
            foreach ($val as $k => $v) {
                $this->normal[$key][$k] = $v / $this->akar[$k];
            }
        }
    }
    function terbobot()
    {
        foreach ($this->normal as $key => $val) {
            foreach ($val as $k => $v) {
                $this->terbobot[$key][$k] = $v * $this->bobot_normal[$k];
            }
        }
    }
    function solusi_ideal()
    {
        $temp = array();
        foreach ($this->terbobot as $key => $val) {
            foreach ($val as $k => $v) {
                $temp[$k][$key] = $v;
            }
        }
        foreach ($temp as $key => $val) {
            $max = max($val);
            $min = min($val);
            if ($this->atribut[$key] == 'benefit') {
                $this->solusi_ideal['positif'][$key] = $max;
                $this->solusi_ideal['negatif'][$key] = $min;
            } else {
                $this->solusi_ideal['positif'][$key] = $min;
                $this->solusi_ideal['negatif'][$key] = $max;
            }
        }
    }
    function jarak_solusi()
    {
        foreach ($this->terbobot as $key => $val) {
            foreach ($val as $k => $v) {
                foreach ($this->solusi_ideal as $a => $b) {
                    $this->matriks_solusi[$a][$key][$k] = pow($v - $b[$k], 2);
                }
            }
        }

        $this->jarak_solusi = array();
        foreach ($this->matriks_solusi as $key => $val) {
            foreach ($val as $k => $v) {
                foreach ($v as $a => $b) {
                    if (!isset($this->jarak_solusi[$k][$key]))
                        $this->jarak_solusi[$k][$key] = 0;
                    $this->jarak_solusi[$k][$key] += $b;
                }
            }
        }
        foreach ($this->jarak_solusi as $key => $val) {
            foreach ($val as $k => $v) {
                $this->jarak_solusi[$key][$k] = sqrt($v);
            }
        }
        //echo '<pre>' . print_r($this->jarak_solusi, 1)  . '</pre>';
    }
    function pref()
    {
        $this->pref = array();
        foreach ($this->jarak_solusi as $key => $val) {
            if (($val['positif'] + $val['negatif']) == 0)
                $this->pref[$key] = 0;
            else
                $this->pref[$key] = $val['negatif'] / ($val['positif'] + $val['negatif']);
        }
    }
}
