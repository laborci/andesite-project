<?php namespace Application\Component\Constant\Permission;

class Group{
	const visitor = [Role::Active];
	const admin = [Group::visitor, Role::Admin];
}

const not = '-';