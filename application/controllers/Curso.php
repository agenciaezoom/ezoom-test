<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends CI_Controller {
    public function lista() {
        $this->load->model("curso_banco");
        $cursos = $this->curso_banco->buscaTodos();
        $data = array("cursos" => $cursos);
        $this->load->view("headers/cabecalho");
        $this->load->view("paginas/cursos", $data);
        $this->load->view("headers/rodape");
    }

    public function deleta() {
        $id = $this->input->get("id");
        $this->load->model("curso_banco");
        $this->curso_banco->deletaCurso($id);
        redirect("/");
    }

    public function formulario_cadastra(){
        $this->load->helper("form");
        $this->load->model("usuario_banco");
        $professores = $this->usuario_banco->buscaTodosProfessores();
        $this->load->view("headers/cabecalho");
        $this->load->view("formularios/curso", array("professores" => $professores));
        $this->load->view("headers/rodape");
    }

    public function cadastra(){
        $curso = array(
            "nome_curso" => $this->input->post("nome"),
            "horas" => $this->input->post("horas"),
            "descricao" => $this->input->post("descricao"),
            "id_professor" => $this->input->post("professores")
        );
        $this->load->model("curso_banco");
        $this->curso_banco->insereCurso($curso);
        redirect("/");
    }

    public function altera() {
        $this->load->helper("form");
        $id = $this->input->get("id");
        $this->load->model("curso_banco");
        $this->load->model("usuario_banco");
        $professores = $this->usuario_banco->buscaTodosProfessores();
        $curso = $this->curso_banco->encontraCurso($id);
        $this->load->view("headers/cabecalho");
        $this->load->view("formularios/altera", array("curso" => $curso, "professores" => $professores));
        $this->load->view("headers/rodape");
    }

    public function alterar() {
        $this->load->model("curso_banco");
        $curso = array(
            "nome_curso" => $this->input->post("nome"),
            "descricao" => $this->input->post("descricao"),
            "horas" => $this->input->post("horas")
        );
        $id = $this->input->post("id");
        $this->curso_banco->alteraCurso($curso, $id);
        redirect("/");
    }

}