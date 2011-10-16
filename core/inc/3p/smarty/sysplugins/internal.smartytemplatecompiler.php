<?php

/**
* Smarty Internal Plugin Smarty Template Compiler Base
* 
* This file contains the basic classes and methodes for compiling Smarty templates with lexer/parser
* 
* @package Smarty
* @subpackage Compiler
* @author Uwe Tews 
*/
/**
* Class SmartyTemplateCompiler
*/
class Smarty_Internal_SmartyTemplateCompiler extends Smarty_Internal_TemplateCompilerBase {
    /**
    * Initialize compiler
    */
    public function __construct($lexer_class, $parser_class, $smarty)
    {
        $this->smarty = $smarty;
        parent::__construct(); 
        // get required plugins
//        $this->smarty->loadPlugin($lexer_class);
//        $this->smarty->loadPlugin($parser_class);
        $this->lexer_class = $lexer_class;
        $this->parser_class = $parser_class;
    } 

    /**
    * Methode to compile a Smarty template
    * 
    * @param  $_content template source
    * @return bool true if compiling succeeded, false if it failed
    */
    protected function doCompile($_content)
    {
        /* here is where the compiling takes place. Smarty
       tags in the templates are replaces with PHP code,
       then written to compiled files. */ 
        // init the lexer/parser to compile the template
        $lex = new $this->lexer_class($_content,$this->smarty);
        $parser = new $this->parser_class($lex, $this); 
        // $parser->PrintTrace();
        // get tokens from lexer and parse them
        while ($lex->yylex() && !$this->abort_and_recompile) {
            // echo "<br>Parsing  {$parser->yyTokenName[$lex->token]} Token {$lex->value} Line {$lex->line} \n";
            $parser->doParse($lex->token, $lex->value);
        } 

        if ($this->abort_and_recompile) {
            // exit here on abort
            return false;
        } 
        // finish parsing process
        $parser->doParse(0, 0); 
        // check for unclosed tags
        if (count($this->_tag_stack) > 0) {
            // get stacked info
            list($_open_tag, $_data) = array_pop($this->_tag_stack);
            $this->trigger_template_error("unclosed {" . $_open_tag . "} tag");
        } 

        if (!$this->compile_error) {
            // return compiled code
            return str_replace(array("?>\n<?php","?><?php"), array('',''), $parser->retvalue);
        } else {
            // compilation error
            return false;
        } 
    } 
} 

?>