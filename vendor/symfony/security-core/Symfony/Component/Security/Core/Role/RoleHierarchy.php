<?php
namespace Symfony\Component\Security\Core\Role;
class RoleHierarchy implements RoleHierarchyInterface
{
    private $hierarchy;
    protected $map;
    public function __construct(array $hierarchy)
    {
        $this->hierarchy = $hierarchy;
        $this->buildRoleMap();
    }
    public function getReachableRoles(array $roles)
    {
        $reachableRoles = $roles;
        foreach ($roles as $role) {
            if (!isset($this->map[$role->getRole()])) {
                continue;
            }
            foreach ($this->map[$role->getRole()] as $r) {
                $reachableRoles[] = new Role($r);
            }
        }
        return $reachableRoles;
    }
    protected function buildRoleMap()
    {
        $this->map = array();
        foreach ($this->hierarchy as $main => $roles) {
            $this->map[$main] = $roles;
            $visited = array();
            $additionalRoles = $roles;
            while ($role = array_shift($additionalRoles)) {
                if (!isset($this->hierarchy[$role])) {
                    continue;
                }
                $visited[] = $role;
                $this->map[$main] = array_unique(array_merge($this->map[$main], $this->hierarchy[$role]));
                $additionalRoles = array_merge($additionalRoles, array_diff($this->hierarchy[$role], $visited));
            }
        }
    }
}
