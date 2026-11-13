<?php
class Usuarios extends Controller{
    public function cadastrar()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (isset($formulario)):

            $dados = [
                'nome' => trim($formulario['nome'] ?? ''),
                'email' => trim($formulario['email'] ?? ''),
                'matricula' => trim($formulario['matricula'] ?? ''),
                'curso' => trim($formulario['curso'] ?? ''),
                'senha' => trim($formulario['senha'] ?? ''),
                'confirma_senha' => trim($formulario['confirma_senha'] ?? ''),
                'termos' => trim($formulario['termos'] ?? ''),
            ];

            var_dump($formulario);

            if (empty($formulario['nome'])):
                $dados['nome_erro'] = 'Preencha o campo nome';
            endif;

            if (empty($formulario['email'])):
                $dados['email_erro'] = 'Preencha o campo e-mail';
            endif;

            if (empty($formulario['matricula'])):
                $dados['matricula_erro'] = 'Preencha o campo matrícula';
            endif;

            if (empty($formulario['curso'])):
                $dados['curso_erro'] = 'Preencha o campo curso';
            endif;

            if (empty($formulario['senha'])):
                $dados['senha_erro'] = 'Preencha o campo senha';
            endif;

            if (empty($formulario['confirma_senha'])):
                $dados['confirma_senha_erro'] = 'Preencha o campo confirma senha';
            endif;

            if (empty($formulario['termos'])):
                $dados['termos_erro'] = 'Você deve aceitar os termos de uso';
            endif;

        else:
            $dados['senha'] = password_hash($formulario['senha'],
            PASSWORD_DEFAULT);
            if($this->usuarioModel->armazenar($dados)):
                Sessao::mensagem('usuario', 'Cadastro realizado com sucesso');
                URL::redirecionar('usuario/login');
              else:
            die('Erro ao armazenar o usuário no banco de dados');
            endif;
        endif;
    else:
            $dados=[
                'nome'=>'',
                'email'=>'',
                'matricula'=>'',
                'curso'=>'',
                'senha'=>'',
                'confirma_senha'=>'',
                'nome_erro'=>'',
                'email_erro'=>'',
                'matricula_erro'=>'',
                'curso_erro'=>'',
                'senha_erro'=>'',
                'confirma_senha_erro'=>'',
                'termos_erro'=>''
        ];
        endif;

        $this->view('usuarios/cadastrar', $dados);
    } // fim da função cadastrar
}//fim da classe Usuarios
