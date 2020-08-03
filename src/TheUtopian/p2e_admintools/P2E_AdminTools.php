<?php
declare(strict_types=1);

namespace TheUtopian\p2e_admintools;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\entity\object\ExperienceOrb;
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
                        if ($entity instanceof ItemEntity or $entity instanceof ExperienceOrb) {
                            $entity->flagForDespawn();
                            ++$cleared;
                            $this->getServer()->broadcastMessage("§o§l§a$player has saved the server From Lag!");
                        }
                    }
                }
        }
        return true;
    }
}