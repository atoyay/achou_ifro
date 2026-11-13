<?php 
class Paginas extends Controller{
    public function index(){
        $dados = [
            'titulo' => 'Página Inicial',
            'descricao' => 'Pagina inicial'
        ];
        $this->view('paginas/inicio', $dados);
    }//fim da funcao index
   public function como_funciona(){
    $dados = [
        'titulo' => 'Como Funciona',
        'descricao' => ''
    ];
     $this->view('paginas/como_funciona', $dados);
    
   }//fim da funcao sobre

   public function cadastra_Objeto(){
        $dados = [
            'titulo' => 'Cadastrar Objeto',
            'descricao' => 'Cadastre um objeto encontrado ou perdido'
        ];
        $this->view('paginas/cadastra_objeto', $dados);

   }//fim da funcao cadastra objeto

      public function contato(){
        $dados = [
            'titulo' => 'Contato',
            'descricao' => ''
        ];
        $this->view('paginas/contato', $dados);
    }//fim da funcao contato

    public function login(){

        $dados = [
            'titulo' => 'Login',
            'descricao' => 'Entre na sua conta'
        ];
        $this->view('paginas/login', $dados);
    }//fim da funcao login

    public function cadastrar(){
        $dados = [
            'titulo' => 'cadastrar',
            'descricao' => 'Crie uma conta'
        ];
        $this->view('paginas/cadastrar', $dados);
    }//fim da funcao cadastrar
}
