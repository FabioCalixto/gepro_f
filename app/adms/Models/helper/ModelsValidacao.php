<?php

/**
 * Descricao de ModelsValidacao
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsValidacao {
    
    private $Nome;
    private $Formato;
            
    function getNome() {
        return $this->Nome;
    }

    public function nomeSlug($Nome) {
        $this->Nome = (string) $Nome;
        $this->Formato['a'] = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª';
        $this->Formato['b'] = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                ';
        
        $this->Nome = strtr(utf8_decode($this->Nome), utf8_decode($this->Formato['a']), $this->Formato['b']);
        
        $this->Nome = strip_tags(trim($this->Nome));
        
        $this->Nome = str_replace(' ', '-', $this->Nome);
        $this->Nome = str_replace(array('-----', '----', '---','--'), '-', $this->Nome);
        
        $this->Nome = strtolower(utf8_decode($this->Nome));
        
        //echo "Nome da Imagem com slug: {$this->Nome}<br>";
        
    }
    
}
