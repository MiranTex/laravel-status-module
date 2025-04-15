<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

# Laravel Status Module

O **Laravel Status Module** é um pacote que facilita o gerenciamento de status para modelos no Laravel, evitando a necessidade de criar tabelas separadas para cada modelo.

## Estrutura do Diretório

Abaixo está a estrutura principal do diretório e uma breve descrição de cada componente:

- **`composer.json`**: Arquivo de configuração do Composer para dependências e autoload.
- **`composer.lock`**: Arquivo gerado automaticamente pelo Composer para garantir reprodutibilidade.
- **`StatusModuleServiceProvider.php`**: Provedor de serviços para registrar e configurar o módulo.

---

### **Raiz da Pasta**

#### **`composer.json`**
Este arquivo define as dependências do pacote e as configurações de autoload para o Laravel Status Module.

**Principais informações:**
- **Nome do pacote:** `dev/laravel-status-module`
- **Descrição:** Um pacote para gerenciar status de modelos sem criar tabelas separadas para cada modelo.
- **Autoload:** Configurado para usar o padrão PSR-4 com o namespace `Dev\LaravelStatusModule`.
- **Dependências principais:**
  - `illuminate/support`
  - `illuminate/database`
- **Dependências de desenvolvimento:** `phpunit/phpunit`

#### **`composer.lock`**
Este arquivo é gerado automaticamente pelo Composer e contém as versões exatas das dependências instaladas. Ele garante que o ambiente seja reproduzível.

#### **`StatusModuleServiceProvider.php`**
Este é o provedor de serviços principal do pacote. Ele registra os serviços, migrações e configurações do módulo.

**Principais funcionalidades:**
- Carrega as migrações do diretório `Migrations`.
- Publica as migrações e o arquivo de configuração `config/status_module.php`.
- Registra bindings e singletons no container de serviços do Laravel, como:
  - `StatusRepositoryInterface` → `StatusRepository`
  - `StatusGroupAssociationInterface` → `StatusGroupAssociationRepository`
  - Singleton `statusGroupService` para gerenciar grupos de status.

---

### **Pasta Utils/Classes**

#### **`StatusList.php`**
Esta classe é uma implementação de uma lista de status que utiliza o padrão `IteratorAggregate` para permitir iteração sobre os status armazenados.

**Principais funcionalidades:**
- **`getIterator`**: Retorna um iterador para os status armazenados.
- **`push`**: Adiciona um novo objeto `Status` à lista de status.

**Uso:**
```php
$statusList = new StatusList();
statusList->push($status);
foreach ($statusList as $status) {
    // Processar cada status
}
```

---

### **Pasta Traits**

#### **`HasStatus.php`**
Este trait adiciona funcionalidades relacionadas ao gerenciamento de status para modelos Eloquent.

**Principais funcionalidades:**
- **`status`**: Define uma relação `BelongsTo` com o modelo `Status`.
- **`getAllwedStatuses`**: Retorna os status permitidos para a classe atual com base na configuração do grupo de status.
- **`getAllowedStatusesStatic`**: Retorna os status permitidos para a classe estática com base na configuração do grupo de status.

**Uso:**
```php
use Dev\LaravelStatusModule\Traits\HasStatus;

class ExampleModel extends Model {
    use HasStatus;

    // Agora você pode acessar os métodos e relações do trait
}

$statuses = ExampleModel::getAllowedStatusesStatic();
```

---

### **Pasta Services**

#### **`StatusGroupService.php`**
Este serviço gerencia grupos de status e suas associações com status individuais.

**Principais funcionalidades:**
- **`getStatusesFromGroups`**: Retorna os status associados a um ou mais grupos de status.
- **`createStatusGroup`**: Cria um novo grupo de status com validação de dados obrigatórios.
- **`addStatusToStatusGroup`**: Adiciona um status a um grupo de status, verificando se ambos existem.
- **`addMultipleStatusToStatusGroup`**: Adiciona múltiplos status a um grupo de status.
- **`getAllowedStatusesFromClass`**: Retorna os status permitidos para uma classe específica com base na configuração do grupo de status.

**Uso:**
```php
$statusGroupService = app(StatusGroupService::class);

// Criar um grupo de status
$statusGroup = $statusGroupService->createStatusGroup([
    'name' => 'Example Group',
    'slug' => 'example-group'
]);

// Adicionar status a um grupo
$statusGroupService->addStatusToStatusGroup($statusGroup, $status);
```

---

### **Pasta Repository**

#### **`StatusRepository.php`**
Este repositório gerencia operações relacionadas ao modelo `Status`.

**Principais funcionalidades:**
- **`createStatus`**: Insere múltiplos registros de status no banco de dados.
- **`getStatusByCode`**: Retorna um status com base no código fornecido.

**Uso:**
```php
$statusRepository = app(StatusRepository::class);

// Criar um novo status
$statusRepository->createStatus([
    'id' => 'uuid',
    'defualt_name' => 'Active',
    'code' => 'active',
    'description' => 'Active status'
]);

// Buscar um status pelo código
$status = $statusRepository->getStatusByCode('active');
```

#### **`StatusGroupAssociationRepository.php`**
Este repositório gerencia associações entre grupos de status e status individuais.

**Principais funcionalidades:**
- **`addStatusToGroup`**: Adiciona um status a um grupo de status com um nome personalizado.
- **`addMultipleStatusToStatusGroup`**: Adiciona múltiplos status a um grupo de status.
- **`removeStatusFromGroup`**: Remove um status de um grupo de status.
- **`disableStatusInStatusGroup`**: Desativa um status em um grupo de status.
- **`enableStatusInStatusGroup`**: Ativa um status em um grupo de status.

**Uso:**
```php
$statusGroupAssociationRepository = app(StatusGroupAssociationRepository::class);

// Adicionar um status a um grupo
$statusGroupAssociationRepository->addStatusToGroup($group, $status, 'Custom Name');

// Desativar um status em um grupo
$statusGroupAssociationRepository->disableStatusInStatusGroup($group, $status);
```

---

### **Pasta Models**

#### **`StatusGroup.php`**
Este modelo representa um grupo de status no banco de dados.

**Principais funcionalidades:**
- **Tabela associada:** `status_groups`
- **Relacionamento `statuses`:** Define uma relação `belongsToMany` com o modelo `Status` através da tabela `status_group_items`.
- **Campos preenchíveis:** `id`, `name`, `slug`.

**Uso:**
```php
$statusGroup = StatusGroup::create([
    'id' => 'uuid',
    'name' => 'Example Group',
    'slug' => 'example-group'
]);

$statuses = $statusGroup->statuses;
```

#### **`Status.php`**
Este modelo representa um status individual no banco de dados.

**Principais funcionalidades:**
- **Tabela associada:** `statuses`
- **Relacionamento `groups`:** Define uma relação `belongsToMany` com o modelo `StatusGroup` através da tabela `status_group_items`.
- **Campos preenchíveis:** `id`, `defualt_name`, `code`, `description`.

**Uso:**
```php
$status = Status::create([
    'id' => 'uuid',
    'defualt_name' => 'Active',
    'code' => 'active',
    'description' => 'Active status'
]);

$groups = $status->groups;
```

---

### **Pasta Migrations**

#### **`2023_10_05_123456_create_status_module_structure.php`**
Esta migração cria as tabelas necessárias para o funcionamento do Laravel Status Module.

**Tabelas Criadas:**
- **`statuses`**: Armazena os status individuais.
  - Campos principais: `id`, `defualt_name`, `code`, `description`, `status`.
- **`status_groups`**: Armazena os grupos de status.
  - Campos principais: `id`, `name`, `slug`, `description`.
- **`status_group_items`**: Relaciona os status aos grupos de status.
  - Campos principais: `status_id`, `status_group_id`, `position`, `custom_name`, `status`.

**Uso:**
- Para aplicar a migração:
  ```bash
  php artisan migrate
  ```
- Para reverter a migração:
  ```bash
  php artisan migrate:rollback
  ```

---

### **Pasta Interfaces**

#### **`StatusRepositoryInterface.php`**
Esta interface define os métodos que devem ser implementados por qualquer repositório que gerencie o modelo `Status`.

**Métodos:**
- **`createStatus`**: Insere múltiplos registros de status no banco de dados.
- **`getStatusByCode`**: Retorna um status com base no código fornecido.

#### **`StatusGroupAssociationInterface.php`**
Esta interface define os métodos que devem ser implementados por qualquer repositório que gerencie associações entre grupos de status e status individuais.

**Métodos:**
- **`addStatusToGroup`**: Adiciona um status a um grupo de status com um nome personalizado.
- **`addMultipleStatusToStatusGroup`**: Adiciona múltiplos status a um grupo de status.
- **`removeStatusFromGroup`**: Remove um status de um grupo de status.
- **`disableStatusInStatusGroup`**: Desativa um status em um grupo de status.
- **`enableStatusInStatusGroup`**: Ativa um status em um grupo de status.

---

### **Pasta Facades**

#### **`StatusGroupFacade.php`**
Esta facade fornece uma interface estática para o serviço `StatusGroupService`, simplificando o acesso aos métodos relacionados a grupos de status.

**Principais métodos disponíveis:**
- **`getStatusesFromGroups`**: Retorna os status associados a um ou mais grupos de status.
- **`createStatusGroup`**: Cria um novo grupo de status.
- **`addMultipleStatusToStatusGroup`**: Adiciona múltiplos status a um grupo de status.
- **`getAllowedStatusesFromClass`**: Retorna os status permitidos para uma classe específica com base na configuração do grupo de status.

**Uso:**
```php
use Dev\LaravelStatusModule\Facades\StatusGroupFacade;

// Criar um grupo de status
$statusGroup = StatusGroupFacade::createStatusGroup([
    'name' => 'Example Group',
    'slug' => 'example-group'
]);

// Obter status de um grupo
$statuses = StatusGroupFacade::getStatusesFromGroups('example-group');
```

---

### **Pasta Config**

#### **`status_module.php`**
Este arquivo de configuração define as opções para o Laravel Status Module.

**Principais Configurações:**
- **`model_groups`**: Mapeia modelos para grupos de status. Exemplo:
  ```php
  'model_groups' => [
      'app\Models\Model' => 'StatusGroupName',
      User::class => 'user-statuses',
  ],
  ```
- **`cache`**: Configurações de cache para os status.
  - **`enabled`**: Define se o cache está ativado.
  - **`duration`**: Duração do cache em minutos.

**Uso:**
- Personalize este arquivo após publicá-lo com o comando:
  ```bash
  php artisan vendor:publish --provider="Dev\LaravelStatusModule\StatusModuleServiceProvider"
  ```

---

## Configuração

1. **Instalação**: Certifique-se de que o módulo está registrado no `composer.json` do projeto principal.
2. **Publicação de Configurações**:
   ```bash
   php artisan vendor:publish --provider="Dev\LaravelStatusModule\StatusModuleServiceProvider"
   ```
3. **Migrações**:
   ```bash
   php artisan migrate
   ```

---

## Próximos Passos

A documentação para as subpastas será adicionada conforme necessário.
