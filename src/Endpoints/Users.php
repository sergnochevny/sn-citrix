<?php

namespace Citrix\Endpoints;

use Citrix\ShareFile\Api\Models\BaseModel;
use Citrix\ShareFile\Api\Models\ClientUser;
use Citrix\ShareFile\Api\Models\Employee;
use Citrix\ShareFile\Api\Models\User;
use Citrix\ShareFile\Api\Models\UserConfirmationSettings;
use Citrix\ShareFile\Api\Models\UserInfo;
use Citrix\ShareFile\Api\Models\UserPreferences;
use Citrix\ShareFile\Api\Models\UserSecurity;
use ait\guzzle\Exception\ClientException;
use GuzzleHttp\Psr7\Stream;
use Citrix\ShareFile\Api\Models\File;
use Citrix\ShareFile\Api\Models\Folder;
use Citrix\ShareFile\Api\Models\Item;
use Citrix\ShareFile\Api\Models\ItemInfo;
use Citrix\ShareFile\Api\Models\Link;
use Citrix\ShareFile\Api\Models\Note;
use Citrix\ShareFile\Api\Models\SearchQuery;
use Citrix\ShareFile\Api\Models\SimpleSearchQuery;

/**
 * @property Users Users
 * @property UserPreferences UserPreferences
 * @property UserSecurity UserSecurity
 * @property array ListUserSharedFolders
 * @property array ListUserTopFolders
 * @property array ListUserNetworkShareConnectors
 * @property array ListUserSharepointConnectors
 * @property UserInfo UserInfo
 * @property Folder HomeFolder
 * @property UserInfo FileBox
 *
 * @method Users setId($value)
 * @method Users setIncludeDeleted($value)
 * @method Users setPushCreatorDefaultSettings($value)
 * @method Users setAddshared($value)
 * @method Users setNotify($value)
 * @method Users setIfNecessary($value)
 * @method Users setAddPersonal($value)
 * @method Users setResetOnMobile($value)
 * @method Users setDeleteCompletely($value)
 *
 */
class Users extends BaseEndpoint
{

    /**
     * @var null
     */
    protected $id = null;
    /**
     * @var string
     */
    protected $endpoint = '/sf/v3/Users';
    /**
     * @var bool
     */
    protected $include_deleted = false;
    /**
     * @var string
     */
    protected $email_address = '';
    /**
     * @var bool
     */
    protected $push_creator_default_settings = true;
    /**
     * @var bool
     */
    protected $addshared = true;
    /**
     * @var bool
     */
    protected $notify = true;
    /**
     * @var bool
     */
    protected $if_necessary = true;
    /**
     * @var bool
     */
    protected $add_personal = true;
    /**
     * @var bool
     */
    protected $reset_on_mobile = false;
    /**
     * @var bool
     */
    protected $delete_completely = false;

    /**
     * @return mixed
     */
    public function getUsers()
    {
        $options = [];
        $query = null;
        if (!(empty($this->email_address)) && is_string($this->email_address)) $query['emailaddress'] = $this->email_address;
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return mixed
     */
    public function getUserPreferences()
    {
        $options = [];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Preferences';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return mixed
     */
    public function getUserSecurity()
    {
        $options = [];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Security';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return array
     */
    public function getListUserSharedFolders()
    {
        $options = [];
        $request = '/AllSharedFolders';
        $res = $this->getRequestParsedBody($request, $options);
        $folders = [];
        if (isset($res->value)) {
            foreach ($res->value as $folder) {
                $class = 'Citrix\\' . str_replace('.', '\\', $folder->{'odata.type'});
                $folders[] = new $class($folder);

            }
        }
        return $folders;
    }

    /**
     * @return array
     */
    public function getListUserTopFolders()
    {
        $options = [];
        $request = '/TopFolders';
        $res = $this->getRequestParsedBody($request, $options);
        $folders = [];
        if (isset($res->value)) {
            foreach ($res->value as $folder) {
                $class = 'Citrix\\' . str_replace('.', '\\', $folder->{'odata.type'});
                $folders[] = new $class($folder);

            }
        }
        return $folders;
    }

    /**
     * @return array
     */
    public function getListUserNetworkShareConnectors()
    {
        $options = [];
        $request = '/NetworkShareConnectors';
        $res = $this->getRequestParsedBody($request, $options);
        $folders = [];
        if (isset($res->value)) {
            foreach ($res->value as $folder) {
                $class = 'Citrix\\' . str_replace('.', '\\', $folder->{'odata.type'});
                $folders[] = new $class($folder);

            }
        }
        return $folders;
    }

    /**
     * @return array
     */
    public function getListUserSharepointConnectors()
    {
        $options = [];
        $request = '/SharepointConnectors';
        $res = $this->getRequestParsedBody($request, $options);
        $folders = [];
        if (isset($res->value)) {
            foreach ($res->value as $folder) {
                $class = 'Citrix\\' . str_replace('.', '\\', $folder->{'odata.type'});
                $folders[] = new $class($folder);

            }
        }
        return $folders;
    }

    /**
     * @return mixed
     */
    public function getUserInfo()
    {
        $options = [];
        $request = '/Info';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @return mixed
     */
    public function getHomeFolder()
    {
        $options = [];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/HomeFolder';
        $res = $this->getRequestParsedBody($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     *
     */
    public function getFileBoxChildren()
    {
        $options = [];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Box';
        $res = $this->getRequestParsedBody($request, $options);
        $fileboxes = [];
        if (isset($res->value)) {
            foreach ($res->value as $box) {
                $class = 'Citrix\\' . str_replace('.', '\\', $box->{'odata.type'});
                $fileboxes[] = new $class($box);

            }
        }
    }

    /**
     *
     */
    public function getFileBoxFolder()
    {
        $options = [];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Box';
        $res = $this->getRequestParsedBody($request, $options);
        $fileboxes = [];
        if (isset($res->value)) {
            foreach ($res->value as $box) {
                $class = 'Citrix\\' . str_replace('.', '\\', $box->{'odata.type'});
                $fileboxes[] = new $class($box);

            }
        }
    }

    /**
     * @param ClientUser $client_user
     * @return mixed
     */
    public function CreateClientUser(ClientUser $client_user)
    {
        $options = [];
        $query['pushCreatorDefaultSettings'] = $this->push_creator_default_settings ? 'true' : 'false';
        $query['addshared'] = $this->addshared ? 'true' : 'false';
        $query['notify'] = $this->notify ? 'true' : 'false';
        $query['ifNecessary'] = $this->if_necessary ? 'true' : 'false';
        $query['addPersonal'] = $this->add_personal ? 'true' : 'false';
        $options = ['json' => $client_user->toArray()];
        if (!empty($query)) $options['query'] = $query;
        $res = $this->postRequest('', $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param Employee $client_user
     * @return mixed
     */
    public function CreateEmployee(Employee $client_user)
    {
        $query['pushCreatorDefaultSettings'] = $this->push_creator_default_settings ? 'true' : 'false';
        $query['addshared'] = $this->addshared ? 'true' : 'false';
        $query['notify'] = $this->notify ? 'true' : 'false';
        $query['ifNecessary'] = $this->if_necessary ? 'true' : 'false';
        $query['addPersonal'] = $this->add_personal ? 'true' : 'false';
        $options = ['json' => $client_user->toArray()];
        if (!empty($query)) $options['query'] = $query;
        $request = '/AccountUser';
        $res = $this->postRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param ClientUser $user
     * @return mixed
     */
    public function UpdateClientUser(ClientUser $user)
    {
        $options = ['json' => $user->toArray()];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $res = $this->patchRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param Employee $user
     * @return mixed
     */
    public function UpdateEmployee(Employee $user)
    {
        $options = ['json' => $user->toArray()];
        $request = '/AccountUser';
        $request .= (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $res = $this->patchRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param array $roles
     * @return mixed
     */
    public function UpdateUserAddRoles(array $roles)
    {
        $options = ['json' => ['Roles' => $roles]];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Roles';
        $res = $this->patchRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param array $roles
     * @return mixed
     */
    public function UpdateUserSetRoles(array $roles)
    {
        $options = ['json' => ['Roles' => $roles]];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Roles';
        $res = $this->putRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param array $roles
     * @return mixed
     */
    public function UpdateUserRemoveRoles(array $roles)
    {
        $options = ['json' => ['Roles' => $roles]];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Roles';
        $res = $this->postRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param UserPreferences $preferences
     * @return mixed
     */
    public function UpdateUserPreferences(UserPreferences $preferences)
    {
        $options = ['json' => $preferences->toArray()];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/Preferences';
        $res = $this->patchRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param $newpass
     * @param $oldpass
     * @return mixed
     */
    public function ResetPassword($newpass, $oldpass)
    {
        $reset_pass = new BaseModel(
            ["NewPassword" => $newpass, "OldPassword" => $oldpass]);
        $options = ['json' => $reset_pass->toArray()];
        $query['notify'] = $this->notify ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/ResetPassword';
        $res = $this->postRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param $email
     */
    public function ForgotPassword($email)
    {
        $options = [];
        $query['email'] = $email;
        $query['resetOnMobile'] = $this->reset_on_mobile ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = '/ForgotPassword';
        $this->postRequest($request, $options);
    }

    /**
     *
     */
    public function SendWelcomeEmail()
    {
        $options = [];
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $request .= '/ResendWelcome';
        $this->postRequest($request, $options);
    }


    /**
     *
     */
    public function DeleteUser()
    {
        $options = [];
        $query['completely'] =  $this->delete_completely ? 'true' : 'false';
        if (!empty($query)) $options['query'] = $query;
        $request = (!empty($this->id)) ? '(' . $this->id . ')' : '';
        $this->deleteRequest($request, $options);
    }

    /**
     * @param UserConfirmationSettings $confirm_settings
     */
    public function UserConfirm(UserConfirmationSettings $confirm_settings)
    {
        $options = ['json' => $confirm_settings->toArray()];
        $request = '/Confirm';
        $this->postRequest($request, $options);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function UserDeleteEmail($email)
    {
        $options = [];
        $query['email'] =  $email;
        if (!empty($query)) $options['query'] = $query;
        $request = '/DeleteEmailAddress';
        $res = $this->postRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function UserMakePrimaryEmail($email)
    {
        $options = [];
        $query['email'] =  $email;
        if (!empty($query)) $options['query'] = $query;
        $request = '/MakePrimary';
        $res = $this->postRequest($request, $options);
        $class = 'Citrix\\' . str_replace('.', '\\', $res->{'odata.type'});
        return new $class($res);
    }

    /**
     * @param $email
     */
    public function UserSendConfirmationEmail($email)
    {
        $options = [];
        $query['email'] =  $email;
        if (!empty($query)) $options['query'] = $query;
        $request = '/SendConfirmationEmail';
        $this->postRequest($request, $options);
    }



}
