<?php
declare(strict_types=1);

namespace TheUtopian\p2e_admintools;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\object\ItemEntity;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class P2E_AdminTools extends PluginBase
{
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
        switch ($command->getName()) {
            case "lagclear":
                $player = $sender->getName();
                $cleared = 0;
                foreach (Server::getInstance()->getLevels() as $level) {
                    foreach ($level->getEntities() as $entity) {
                        if ($entity instanceof ItemEntity) {
                            $entity->flagForDespawn();
                            ++$cleared;
                        }
                    }
                }
                $this->getServer()->broadcastMessage("§l§c[§bP§a2§bE§c] §o§d$player §ahas just saved the server from Lag!");
        }
        return true;
    }
}