<?php

namespace Etherscan\Api;

class Accounts extends Request
{
    public function getAddressBalance(string $address)
    {
        $this->setQuery([
            'module'  => 'account',
            'action'  => 'balance',
            'address' => $address,
        ]);

        return $this->send();
    }

    public function getMultipleAddressesBalance(array $addresses)
    {
        $addressList = implode(',', $addresses);

        $this->setQuery([
            'module'  => 'account',
            'action'  => 'balancemulti',
            'address' => $addressList,
        ]);

        return $this->send();
    }

    public function getAddressTransactionList(string $address, int $startBlock = 0, int $endBlock = 0, int $page = 1, int $offset = 10, string $sort = 'asc')
    {
        $this->setQuery([
            'module'     => 'account',
            'action'     => 'txlist',
            'address'    => $address,
            'startblock' => $startBlock,
            'endblock'   => $endBlock,
            'page'       => $page,
            'offset'     => $offset,
            'sort'       => $sort,
        ]);

        return $this->send();
    }

    public function getAddressInternalTransactionList(string $address, int $startBlock = 0, int $endBlock = 0, int $page = 1, int $offset = 10, string $sort = 'asc')
    {
        $this->setQuery([
            'module'     => 'account',
            'action'     => 'txlistinternal',
            'address'    => $address,
            'startblock' => $startBlock,
            'endblock'   => $endBlock,
            'page'       => $page,
            'offset'     => $offset,
            'sort'       => $sort,
        ]);

        return $this->send();
    }
}