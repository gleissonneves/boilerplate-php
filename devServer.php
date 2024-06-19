<?php

function getLocalIP() {
    return getHostByName(getHostName());
}

function showHelp() {
    echo "Lista de comandos do devServer.php \n";
    echo "-------------------------------------- \n";
    echo "php devServer.php - Executa o ambiente local necessário para o desenvolvimento. \n";
    echo "php devServer.php --expor - Executa o ambiente no ip da sua máquina caso deseje depurar em outros locais enquanto desenvolve. \n";
    echo "php devServer.php --controller <ControllerName> - Cria um novo controller baseado no template.";
}

function createController($controllerName) {
    $stubPath = __DIR__ . '/src/application/controller/stubs/controller.stubs';
    $controllerDir = __DIR__ . '/src/application/controller';
    $controllerFile = $controllerDir . '/' . $controllerName . 'Controller.php';

    if (!file_exists($stubPath)) {
        echo "Template de controller não encontrado.\n";
        return;
    }

    if (!file_exists($controllerDir)) {
        mkdir($controllerDir, 0777, true);
    }

    $stub = file_get_contents($stubPath);
    $controllerContent = str_replace('{class}', $controllerName . 'Controller', $stub);

    if (file_put_contents($controllerFile, $controllerContent) !== false) {
        echo "Controller {$controllerName}Controller criado com sucesso em {$controllerFile}\n";
    } else {
        echo "Erro ao criar o controller.\n";
    }
}

if (in_array('--help', $argv)) {
    showHelp();

} elseif (in_array('--expor', $argv)) {
    $ip = getLocalIP();
    $port = '8001';
    $command = "php -S $ip:$port";
    passthru($command);


} elseif (in_array('--controller', $argv)) {
    $key = array_search('--controller', $argv);
    if (isset($argv[$key + 1])) {
      $controllerName = $argv[$key + 1];
      createController($controllerName);
    } else {
      echo "Nome do controller não fornecido.\n";
      showHelp();
    }
} else {
    $command = "php -S 127.0.0.1:8001";
    passthru($command);
}
?>
