<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
	public function getData()
	{
		return $this->db->table('users')
			->select('users.id as userid, email, username, telp, alamat, name')
			->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
			->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
			->get()->getResult();
	}
}
