<?php
namespace Restgrip\Sodium\Service;

use Restgrip\Service\ServiceAbstract;
use Sodium;

/**
 * @package   Restgrip\Sodium\Service
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class SodiumService extends ServiceAbstract
{
    /**
     * @var string
     */
    protected $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    
    /**
     * Hash password using Argon2i
     *
     * @param string $password
     *
     * @return string
     */
    public function passwordCreate(string $password) : string
    {
        $passwordHash = Sodium\crypto_pwhash_str(
            $password,
            Sodium\CRYPTO_PWHASH_OPSLIMIT_INTERACTIVE,
            Sodium\CRYPTO_PWHASH_MEMLIMIT_INTERACTIVE
        );
        
        $this->wipeMemory($password);
        
        return $passwordHash;
    }
    
    /**
     * @param string $password
     * @param string $hash
     *
     * @return bool
     */
    public function passwordVerify(string $password, string $hash) : bool
    {
        if (Sodium\crypto_pwhash_str_verify($hash, $password)) {
            $this->wipeMemory($password);
            
            return true;
        }
        
        $this->wipeMemory($password);
        
        return false;
    }
    
    /**
     * @param int    $length
     * @param string $keyspace
     *
     * @return string
     */
    public function randomString(
        int $length = 32,
        string $keyspace = ''
    ) : string {
        if (!$keyspace) {
            $keyspace = $this->keyspace;
        }
        
        $string  = '';
        $keysize = strlen($keyspace);
        
        for ($i = 0; $i < $length; ++$i) {
            $string .= $keyspace[Sodium\randombytes_uniform($keysize)];
        }
        
        return $string;
    }
    
    /**
     * Prepend string to default keyspace
     *
     * @param string $keyspace
     *
     * @return $this
     */
    public function prependKeyspace(string $keyspace)
    {
        $this->keyspace = $keyspace.$this->keyspace;
        
        return $this;
    }
    
    /**
     * @param $var
     */
    public function wipeMemory($var)
    {
        Sodium\memzero($var);
    }
}