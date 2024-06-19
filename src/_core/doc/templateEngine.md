# Documentação para Utilização do Sistema de Template

Este documento fornece uma visão geral de como utilizar o sistema de template construído com a classe TemplateEngine e a FrontController. Este sistema permite a criação de layouts com herança de templates e blocos de conteúdo dinâmico.

## Estrutura de Arquivos

``` 
views
 ┣ layout
 ┃ ┣ plataforma
 ┃ ┃ ┣ footer.php
 ┃ ┃ ┗ layout.php
 ┃ ┗ .gitkeep // não necessita deste arquivo
 ┗ dashboard.php
```

## Configuração Inicial
__*TemplateEngine.php*__ = Classe responsável pelo gerenciamento de templates, herança e blocos de conteúdo dinâmico.

__*FrontController.php*__ = Classe base que todas as controllers estendem para utilizar a funcionalidade de renderização de templates.

__*DashboardController.php*__ = Exemplo de uma controller específica que estende FrontController e utiliza o método view para renderizar um template.

exemplo de uso:
### Criando a controller
```PHP
class DashboardController extends FrontController {
    public function index() {
        $data = [
            'nome' => 'Página Inicial',
            'idade' => 'Este é o conteúdo da página inicial.'
        ];

        $this->view('dashboard', $data);
    }
}

```
### Criando Templates
#### Template Principal (layout.php)
Este é o template base (comun) que outras views podem estender.

```PHP
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
      <?php 
        $this->block('title', 'Meu sistema'); //bloco inicialização com padrão para caso não seja inicializado
      ?>
    </title>

    <?php 
      $this->block('css');
    ?>
</head>
<body>
    <?php $this->block('content'); ?>
    
    <?php require_once('footer.php'); ?>

    <?php 
      $this->block('script');
    ?>
</body>
</html>
```

#### Template Específico (dashboard.php)
Este template específico estende o layout.php e define seus próprios blocos de conteúdo. Dada a nossa estrutura de pastas faremos da seguinte forma


```PHP
<?php $this->extend('layout/plataforma/layout') ?>

<?php $this->startBlock('css'); ?>
  <link rel="stylesheet" href="<?= assets('style/css/my-page.css')?>">
<?php $this->endBlock(); ?>


<?php $this->startBlock('content'); ?>
  <h2><?= $title ?> tenho <?= $title ?> de idade</h2>
  <p>Este é o meu portifólio.</p>
<?php $this->endBlock(); ?>

<?php $this->startBlock('script'); ?>
   <script src="<?= assets('page/abc.js')?>"></script>
<?php $this->endBlock(); ?>
```