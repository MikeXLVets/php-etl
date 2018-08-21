<?php

namespace Tests\Database;

use PDOStatement;
use Tests\TestCase;
use Marquine\Etl\Database\Statement;
use Marquine\Etl\Database\Connection;

class StatementTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->connection = $this->getMockBuilder(Connection::class)->setMethods(['prepare'])->disableOriginalConstructor()->getMock();
        $this->statement = $this->createMock(PDOStatement::class);
    }

    /** @test */
    public function select()
    {
        $statement = new Statement($this->connection);

        $statement->select('users');

        $this->assertEquals('select * from users', $statement->toSql());

        $statement = new Statement($this->connection);

        $statement->select('users', ['name', 'email']);

        $this->assertEquals('select name, email from users', $statement->toSql());
    }

    /** @test */
    public function insert()
    {
        $statement = new Statement($this->connection);

        $statement->insert('users', ['name', 'email']);

        $this->assertEquals('insert into users (name, email) values (:name, :email)', $statement->toSql());
    }

    /** @test */
    public function update()
    {
        $statement = new Statement($this->connection);

        $statement->update('users', ['name', 'email']);

        $this->assertEquals('update users set name = :name, email = :email', $statement->toSql());
    }

    /** @test */
    public function delete()
    {
        $statement = new Statement($this->connection);

        $statement->delete('users');

        $this->assertEquals('delete from users', $statement->toSql());
    }

    /** @test */
    public function where()
    {
        $statement = new Statement($this->connection);

        $statement->where(['name', 'email']);

        $this->assertEquals('where name = :name and email = :email', $statement->toSql());
    }

    /** @test */
    public function prepare()
    {
        $this->connection->expects($this->once())->method('prepare')->with('')->willReturn($this->statement);

        $statement = new Statement($this->connection);

        $this->assertInstanceOf(PDOStatement::class, $statement->prepare());
    }
}
