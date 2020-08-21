<?php

namespace Drama_Lvl1\TransferUI;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\Server;
use onebone\economyapi\EconomyAPI;
use pocketmine\plugin\PluginBase;
use _64FF00\PurePerms\PurePerms;
use jojoe77777\FormAPI;

class Main extends PluginBase{

    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
        if($cmd->getName() === "transferui"){
            if($sender->hasPermission("transferui.use")){
                if($sender instanceof Player) {
                    $this->TransferUI($sender);
                }
            }
            if(!$sender->hasPermission("transferui.use")){
                $sender->sendMessage("§8[§6TransferUI§8] §cYou do not have permission to use this command!");
            }
        }
    return true;
    }

    public function TransferUI(Player $player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function(Player $player, $data){
            if($data === null){
                return true;
            }
            $player->sendMessage("§8[§6TransferUI§8] §6IP: " . $data[1] . "\n§8[§6TransferUI§8] §6Port: " . $data[2] . "");
            if(empty($data[1] and $data[2])){
                $player->sendMessage("§8[§6TransferUI§8] §cPlease Enter a Server Address or Port");
                $player->sendMessage("§8[§6TransferUI§8] §cCancelled");
                $this->TransferUI2($player);

            } else {
                $player->sendMessage("§8[§6TransferUI§8] §aTransfering");
                $player->transfer($data[1], $data[2]);
            }
        });
        $form->setTitle("§8[§6TransferUI§8]");
        $form->addLabel("§8[§6TransferUI§8] §7Enter a Server Address & Port");
        $form->addInput("§61. Server Address", "server.net");
        $form->addInput("§62. Server Port", "19132");

        $form->sendToPlayer($player);

        return $form;
    }
    public function TransferUI2(Player $player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createCustomForm(function(Player $player, $data){
            if($data === null){
                return true;
            }
            $player->sendMessage("§8[§6TransferUI§8] §6IP: " . $data[1] . "\n§8[§6TransferUI§8] §6Port: " . $data[2] . "");
            if(empty($data[2] and $data[3])){
                $player->sendMessage("§8[§6TransferUI§8] §cPlease Enter a Server Address or Port");
                $player->sendMessage("§8[§6TransferUI§8] §cCancelled");
                $this->TransferUI2($player);

            } else {
                $player->sendMessage("§8[§6TransferUI§8] §aTransfering");
                $player->transfer($data[2], $data[3]);
            }
        });
        $form->setTitle("§8[§6TransferUI§8]");
        $form->addLabel("§8[§6TransferUI§8] §7Enter a Server Address & Port");
        $form->addLabel("§cERROR: §7Please dont let the Port or the Address empty");
        $form->addInput("§61. Server Address", "server.net");
        $form->addInput("§62. Server Port", "19132");

        $form->sendToPlayer($player);

        return $form;
    }
}