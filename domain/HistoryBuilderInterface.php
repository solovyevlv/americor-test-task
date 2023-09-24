<?php

namespace app\domain;

use app\domain\entity\Call;
use app\domain\entity\Customer;
use app\domain\entity\Event;
use app\domain\entity\History;
use app\domain\entity\Sms;
use app\domain\entity\Task;
use app\domain\entity\User;

interface HistoryBuilderInterface
{
    public function addCall(Call $call): HistoryBuilderInterface;

    public function addCustomer(Customer $customer): HistoryBuilderInterface;

    public function addUser(User $user): HistoryBuilderInterface;

    public function addTask(Task $task): HistoryBuilderInterface;

    public function addSms(Sms $sms): HistoryBuilderInterface;

    public function addEvent(Event $event): HistoryBuilderInterface;

    public function addInsTs(?string $ts = ''): HistoryBuilderInterface;

    public function build(): History;
}
