<?php namespace Application\Constant\Permission;

class Group{
	const anonymized = [];
	const visitor = [Role::Active];
	const admin = [Role::Active, Role::Admin];
}

const not = '-';