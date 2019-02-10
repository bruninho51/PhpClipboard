# PhpClipboard
Biblioteca PHP para criação de formulários em HTML.

## Instalando
Primeiro de tudo, é necessário baixar a biblioteca. Você pode usar o Composer para isso:<br>
`composer require bruninho51/php-clipboard @dev`

## Criando Tabelas
Em seguida, você deverá criar as tabelas que a biblioteca necessita. Para isto, rode o script **database.sql**, disponível em vendor/bruninho51/php-clipboard.

## Criando o Adaptador
Para que a biblioteca possa se comunicar com  o banco, é necessário que você crie um adaptador. O adaptador deve respeitar a interface **IphpClipboardAdapter**. Na pasta example, há um exemplo de implementação de adaptador utilizando PDO.

## Chamando um formulário
Veja abaixo um exemplo de como gerar o HTML de um formulário cadastrado:


<code>include_once __DIR__ . '/../vendor/autoload.php';</code><br>
<code>include 'AdapterExample.php';</code><br>
<code>$adapter = new AdapterExample;</code><br>
<code>$myClip = new PhpClipboard\PhpClipboard($adapter);</code><br>
<code>$form = $myClip->getForm(1);</code><br>
<code>echo $form->getHTML('Action.php', 'default')</code>

1. Você deverá instanciar seu adaptador;
2. Em seguida, deve instanciar o PhpClipboard passando o adaptador no contrutor;
3. Chame o método getForm, passando o id do formulário. Ele retornará um objeto do tipo FormPhpClipboard;
4. Com o objeto acima em mãos, chame o método getHTML, passando a action do formulário e o nome do template.

## Criando Regras de Formulário
Para criar uma regra, crie uma classe na pasta vendor/bruninho51/php-clipboard/roles. A classe deve herdar da classe RolePhpClipboard. Um método chamado role deve ser criado, com um argumento de nome $form, do tipo IFormPhpClipboad. É nesse método que a validação deve ser implementada.
Em caso de erro, você deve emitir uma Exception, que será tratada pela biblioteca.

## MyProcessPhpClipboard
No banco de dados, na tabela de formulário existem as seguintes colunas: processValidateSuccess e processValidateFailure. Você deverá criar dois métodos em vendor/bruninho51/php-clipboard/src/MyProcessPhpClipboard.php: Um para ser chamado caso a validação do formulário falhe, e outro para ser chamado caso os dados enviados pelo usuário passe na validação. O nome dos métodos devem ser colocados nas respectivas colunas. Exemplo de método de tratamento em MyProcessPhpClipboard:

<code>function myProcessExample(FormPhpClipboard $form)
{

}</code>

Perceba que o método deve ter um argumento do tipo FormPhpClipboard. A biblioteca fará a injeção de dependência do formulário enviado pelo usuário automáticamente.

## Criando Templates de Formulário
Os templates de formulário devem ser criados na pasta vendor/bruninho51/php-clipboard/templates. Eles devem ser colocados na raiz dessa pasta. O contexto do template é a interface IphpClipboardTemplate. Chame os métodos usando $this. A interface possui métodos tanto para conseguir informações do formulário, como nome e id, como as informações dos campos.

## Entradas Personalizadas
Por padrão, a biblioteca cria entradas de formulário comuns, mas você pode criar entradas personalizadas. Para criar uma entrada personalizada, crie um template em vendor/bruninho51/php-clipboard/templates/components.
O contexto do template é o objeto PhpClipboardComponentEntry. Você poderá usar as propriedades e métodos desse objeto para resgatar os dados da entrada de formulário, e assim, criar sua entrada personalizada. Para acessar os métodos, use $this.
Em seguida, você deverá criar uma classe em vendor/bruninho51/php-clipboard/components. Ela deve ter o namespace **PhpClipboard\Components**, herdar de **PhpClipboardComponentEntry** e também deve ser criado o atributo **$template**, com o nome do template criado anteriormente.
Com o componente criado, entre no registro do banco de dados, na tabelas de campos, e na coluna component, coloque o nome da classe criada.

**Exemplo Prático**
Para um melhor exemplo, entre na pasta example, em vendor/bruninho51/php-clipbord.
