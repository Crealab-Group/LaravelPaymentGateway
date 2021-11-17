<?php

namespace Crealab\PaymentGateway\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


class MakePaymentCommand extends GeneratorCommand
{
    /**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
    protected $name = 'make:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new Payment';


    /**
	 * The type of class being generated.
	 *
	 * @var string
	 */
    protected $type = 'Payment';

     /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);

        return str_replace('DummyPayment', $this->argument('name'), $stub);
    }

	/**
	 * Get the stub file for the generator.
	 *
	 * @return string
	 */
	protected function getStub()
	{
		return  dirname( dirname(__FILE__) ).'/Stubs/Payment.stub';
	}

	/**
	 * Get the default namespace for the class.
	 *
	 * @param  string  $rootNamespace
	 * @return string
	 */
	protected function getDefaultNamespace($rootNamespace)
	{
		return $rootNamespace . '\Payments';
	}

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the contract.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', null, InputOption::VALUE_NONE, 'Create the abstract class even if it already exists'],
        ];
    }

}
