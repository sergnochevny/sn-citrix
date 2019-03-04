Citrix ShareFile API Implementation
===================================

## Install (composer)

composer.json add
```php
  "repositories": {
    "ait-citrix": {
      "type": "git",
      "url": "https://gitlab.ait.com/ait/citrix"
    },
    "ait-guzzle": {
      "type": "git",
      "url": "https://gitlab.ait.com/ait/guzzle"
    }
  },
  "require": {
  }
  "require-dev": {
    "ait/citrix": "1.0.5"
  }
```
command line
```cmd
  composer install --dev
```

## Help and docs

- [Citrix Documentation](https://api.sharefile.com/rest/docs/resource.aspx)


## Initialization Library

```php
include_once(__DIR__ . 'vendor/autoload.php');

use Citrix\CitrixApi;

$Citrix = new CitrixApi();
$Citrix->setSubdomain('aitSergNochevny')
    ->setClientId('BeSwplmwMiosNPiZP3oEKVN9Eb2chfSk')
    ->setClientSecret('S3pKYPoZ6hKS0TkU5h3LBP6wKO9oFxeGqljNIfKyTt7PYxX3')
    ->setUsername('serg.nochevny@engineering.ait.com')
    ->setPassword('1qWerty@-')
    ->setLogging(true)
    ->Initialize();
```

## Items(Folder Files etc) Implementation
- [Citrix Items Documentation](https://api.sharefile.com/rest/docs/resource.aspx?name=Items)

- Root
```php
$items = $src->Items;
$root = $items
    ->setExpandChildren(CitrixApi::TRUE)
    ->setFilter(\src\Endpoints\Items::SHORT_FORMAT)
    ->Root;
```
- Items
```php
$item = $items
    ->setId("foh3f9ea-9b95-4b3a-86aa-36bd103ddcef")
    ->Items;
```

- Tree
```php
$tree = $items
    ->setId("foh3f9ea-9b95-4b3a-86aa-36bd103ddcef")
    ->Tree;
```

- Parent
```php
$parent = $items
    ->setId("foh3f9ea-9b95-4b3a-86aa-36bd103ddcef")
    ->setExpandChildren(CitrixApi::FALSE)
    ->setFilter(\src\Endpoints\Items::FULL_FORMAT)
    ->Parent;
```

- Items By Path
```php
$items = $items
    ->setId("foh3f9ea-9b95-4b3a-86aa-36bd103ddcef")
    ->setId("fo00ec76-012f-44db-8361-7a5d3b50d213")
    ->setPath("/Test/iluvfabrix.sql.zip")
    ->setExpandChildren(CitrixApi::FALSE)
    ->setFilter(\src\Endpoints\Items::SHORT_FORMAT)
    ->ItemsByPath;
```

- Item Acces Info
```php
$info = $items
    ->setId("foh3f9ea-9b95-4b3a-86aa-36bd103ddcef")
    ->setId("fo00ec76-012f-44db-8361-7a5d3b50d213")
    ->setExpandChildren(\src\Endpoints\Items::FALSE)
    ->setFilter(\src\Endpoints\Items::SHORT_FORMAT)
    ->ItemAccessInfo;
```

- Download Item (file)
```php
$item_content = $items
    ->setId("fi5b42ec-0fea-f71b-83a5-f39cd2d11fb6")
    ->setExpandChildren(CitrixApi::FALSE)
    ->ItemContent;
```

- Stream
```php
$stream = $items
    ->setId("st920b6b-5a09-4508-ae7f-394b103ade4d")
    ->setExpandChildren(CitrixApi::TRUE)
    ->Stream;
```

- Thumbnail - download
```php
$iteminfo = $items
    ->setId("fi68d7aa-b085-9501-09d6-c2dedd8d489e")
    ->Items;
$size = $iteminfo->FileSizeBytes;
$thumbnailstream = $items
    ->setId("fi68d7aa-b085-9501-09d6-c2dedd8d489e")
    ->setThumbnailSize(\src\Endpoints\Items::THUMBNAIL_SMALL)
    ->ThumbnailStream;
$f = fopen(__DIR__ . '/tmb.jpg','wb');
fwrite($f, $thumbnailstream->read($size));
fflush($f);
fclose($f);
```

- Thumbnail of an image - uri
```php
$thumbnail = $items
    ->setId("fi68d7aa-b085-9501-09d6-c2dedd8d489e")
    ->setThumbnailSize(\src\Endpoints\Items::THUMBNAIL_SMALL)
    ->Thumbnail;
```

- Delete
```php
$delete_item = $items
    ->setId("fo00ec76-012f-44db-8361-7a5d3b50d213")
    ->DeleteItem();
```

- Create Folder
```php
$folder = new \src\ShareFile\Api\Models\Folder(['Name' => 'Test', 'Description' => 'Just a Test']);
$create_folder = $items
    ->setId("foh3f9ea-9b95-4b3a-86aa-36bd103ddcef")
    ->setOverwrite(CitrixApi::TRUE)
    ->CreateFolder($folder);
```

- Upload File
```php
$file = dirname(__FILE__) . '/fiddlersetup.exe';
$upload_file = $items
    ->setId("foh3f9ea-9b95-4b3a-86aa-36bd103ddcef")
    ->UploadFile($file);
```

- Update Item
```php
//$item = new \src\ShareFile\Api\Models\Item();
$item = $items
    ->setExpandChildren(CitrixApi::FALSE)
    ->setId("fo0df84d-f5e9-4041-9cb5-46f40cc42d63")
    ->Items;
$item->Name = 'Test_Updated';
$update_item = $items->UpdateItem($item);
```

- Notes
```php
$note = new \src\ShareFile\Api\Models\Note(['Name'=>'TestNote']);
$create_note = $items
    ->setId("fo0df84d-f5e9-4041-9cb5-46f40cc42d63")
    ->CreateNote($note);
```

- Search
```php
$search = $items
    ->setId("")
    ->Search('test');
```
```php
$query = new \src\ShareFile\Api\Models\SimpleSearchQuery();
$query->Query
    ->setSearchQuery('test')
    ->setItemType('Folder');
$advsimplesearch = $items
    ->AdvansedSimpleSearch($query);
```
```php
$query = new \src\ShareFile\Api\Models\SearchQuery();
$query->Query
    ->setSearchQuery('test')
    ->setItemTypes(['Folder']);
$advsearch = $items
    ->AdvansedSearch($query);
```

- Zones
```php
$zones = $Citrix->Zones;
$zone = $zones->Zones;
$zone = $zones
    ->setId("zpc3159d90-01f7-41a7-a8ab-3704157466")
    ->setSecret(CitrixApi::TRUE)
    ->Zone;
```

## Users Implementation

- [Citrix Users Documentation](https://api.sharefile.com/rest/docs/resource.aspx?name=Users)

- Users
```php
$users = $Citrix->Users;
$user = $users
    ->setId("9141f2dc-d6db-403d-8cd7-ae199f4c1cc5")
    ->setEmailAddress("serg.nochevny@engineering.ait.com")
    ->Users;
```

- User Preferences
```php
$preferences = $users
    ->setId("9141f2dc-d6db-403d-8cd7-ae199f4c1cc5")
    ->UserPreferences;
```

- User Security
```php
$security = $users
    ->setId("9141f2dc-d6db-403d-8cd7-ae199f4c1cc5")
    ->UserSecurity;
```

- User Info
```php
$userinfo = $users
    ->setId("9141f2dc-d6db-403d-8cd7-ae199f4c1cc5")
    ->UserInfo;
```

- Create Client
```php
$client_user = (new \src\ShareFile\Api\Models\ClientUser())
    ->setCompany('ait')
    ->setFirstName('Serg')
    ->setLastName('Nochevny')
    ->setEmail('sergnochevny@gmail.com')
    ->setPassword('1qWerty@');
$user = $users
    ->CreateClientUser($client_user);
```

- Create Employee
```php
$employee = (new \src\ShareFile\Api\Models\Employee())
    ->setCompany('_ait_')
    ->setFirstName('Serg')
    ->setLastName('Nochevny')
    ->setEmail('sergnochevny@gmail.com')
    ->setPassword('1qWerty@')
    ->setCanCreateFolders(CitrixApi::TRUE);
$user = $users
    ->CreateEmployee($employee);
```

- Update Client Info
```php
$client_user = (new \src\ShareFile\Api\Models\ClientUser())
    ->setCompany('ait')
    ->setFirstName('Serg')
    ->setLastName('Nochevniy');
$user = $users
    ->setId('14700b81-602d-4a29-ac8f-3eec2f4a8d2d')
    ->UpdateClientUser($client_user);
```

- Add User Roles
```php
$user = $users
    ->setId('14700b81-602d-4a29-ac8f-3eec2f4a8d2d')
    ->UpdateUserAddRoles([
      "CanChangePassword", "CanManageMySettings",
      "CanUseFileBox", "CanManageUsers", "CanCreateFolders", "CanUseDropBox", "CanSelectFolderZone",
      "AdminAccountPolicies", "AdminBilling", "AdminBranding", "AdminChangePlan", "AdminFileBoxAccess",
      "AdminManageEmployees", "AdminRemoteUploadForms", "AdminReporting", "AdminSharedDistGroups",
      "AdminSharedAddressBook", "AdminViewReceipts", "AdminDelegate", "AdminManageFolderTemplates",
      "AdminEmailMessages", "AdminSSO", "AdminSuperGroup", "AdminZones", "AdminCreateSharedGroups", "AdminConnectors"
 ]);
```

- Set Roles
```php
$user = $users
    ->setId('14700b81-602d-4a29-ac8f-3eec2f4a8d2d')
    ->UpdateUserSetRoles([
      "CanChangePassword", "CanManageMySettings",
      "CanUseFileBox", "CanManageUsers", "CanCreateFolders", "CanUseDropBox", "CanSelectFolderZone",
      "AdminAccountPolicies", "AdminBilling", "AdminBranding", "AdminChangePlan", "AdminFileBoxAccess",
      "AdminManageEmployees", "AdminRemoteUploadForms", "AdminReporting", "AdminSharedDistGroups",
      "AdminSharedAddressBook", "AdminViewReceipts", "AdminDelegate", "AdminManageFolderTemplates",
      "AdminEmailMessages", "AdminSSO", "AdminSuperGroup", "AdminZones", "AdminCreateSharedGroups", "AdminConnectors"
 ]);
```

- Remove Roles
```php
$user = $users
    ->setId('14700b81-602d-4a29-ac8f-3eec2f4a8d2d')
    ->UpdateUserRemoveRoles([
        "AdminManageEmployees", "AdminRemoteUploadForms", "AdminReporting", "AdminSharedDistGroups",
        "AdminSharedAddressBook", "AdminViewReceipts", "AdminDelegate", "AdminManageFolderTemplates",
        "AdminEmailMessages", "AdminSSO", "AdminSuperGroup", "AdminZones", "AdminCreateSharedGroups", "AdminConnectors"
    ]);
```

- Update Employee 
```php    
$employee = (new \src\ShareFile\Api\Models\Employee())
    ->setCompany('_ait_')
    ->setFirstName('Serg')
    ->setLastName('Nochevny');
$user = $users
    ->setId('14700b81-602d-4a29-ac8f-3eec2f4a8d2d')
    ->UpdateEmployee($employee);
```

- Reset Password
```php
$user = $users
    ->setId('14700b81-602d-4a29-ac8f-3eec2f4a8d2d')
    ->ResetPassword('1qWerty@', '1qWerty@--');
```

- Forgot Password
```php
$user = $users
    ->setResetOnMobile(CitrixApi::TRUE)
    ->ForgotPassword('sergnochevny@gmail.com');
```

- Delete User
```php
$user = $users
    ->setId('14700b81-602d-4a29-ac8f-3eec2f4a8d2d')
    ->setDeleteCompletely(CitrixApi::TRUE)
    ->DeleteUser();
```

- User Delete Email
```php
$user = $users
    ->UserConfirm(new \src\ShareFile\Api\Models\UserConfirmationSettings());
    ->UserMakePrimaryEmail('sergnochevny@gmail.com');
    ->UserSendConfirmationEmail('sergnochevny@gmail.com');
    ->UserDeleteEmail('sergnochevny@gmail.com');
```

- UserMakePrimaryEmail($email)
- UserSendConfirmationEmail($email)